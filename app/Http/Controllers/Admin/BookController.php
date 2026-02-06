<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('category')->get();
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'isbn' => 'required|string|max:20',
            'publication_year' => 'required|integer|min:1000|max:9999',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|max:5126',
            'description' => 'nullable|string'
        ]);

        $defaultImage = 'defaults/default-book-cover.avif';
        $imagePath = null;

        // if request contains a FileUpload, store it in disk and get path
        // then map the path to the validated data array to store in db
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');
            $data['cover_image_url'] = $imagePath;
        } else {
            $data['cover_image_url'] = $defaultImage;
        }

        // if db transaction fails, delete the stored image in the disk
        try {
            DB::beginTransaction();
            Book::create($data);
            DB::commit();
            return redirect()->route('admin.books.index')->with('success', 'Book created successfully.');
        } catch (\Throwable $e) {
            DB::rollback();
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            return redirect()->back()->withInput()->with('error', 'Failed to create book.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'author' => 'sometimes|string|max:255',
            'category_id' => 'sometimes|exists:categories,id',
            'isbn' => 'sometimes|string|max:20',
            'publication_year' => 'sometimes|integer|min:1000|max:9999',
            'price' => 'sometimes|numeric|min:0',
            'stock_quantity' => 'sometimes|integer|min:0',
            'image' => 'nullable|image|max:5126',
            'description' => 'nullable|string'
        ]);

        $newImagePath = null;
        $oldImage = $book->cover_image_url;

        if($request->hasFile('image')) {
            $newImagePath = $request->file('image')->store('books', 'public');
            $data['cover_image_url'] = $newImagePath;
        }

        try {
            DB::beginTransaction();
            $book->update($data);
            DB::commit();

        } catch (\Throwable $e) {
            DB::rollback();
            if ($newImagePath) {
                Storage::disk('public')->delete($newImagePath);
            }
            return redirect()->back()->withInput()->with('error', 'Unable to update book.');
        }

        // only delete old image path if a new one has been generated
        if ($newImagePath && $oldImage) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()->route('admin.books.index')->with('success', 'Book successfully edited');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully.');
    }
}
