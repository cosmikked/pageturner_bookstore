<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('books')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|max:5126'
        ]);

        $path = $request->file('image')->store('categories', 'public');

        $data['image_url'] = $path;


        try {
            DB::beginTransaction();
            Category::create($data);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            Storage::disk('public')->delete($path);
            throw $e;
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * @throws \Throwable
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
           'name' => 'sometimes|string|max:255',
           'description' => 'sometimes|string',
           'image' => 'sometimes|image|max:2048'
        ]);

        $oldImage = $category->image_url ?? null;
        $newImagePath = null;


        if($request->hasFile('image')) {
            // store the new image in public/categories/ in the storage/app/ directory and get the path
            $newImagePath = $request->file('image')->store('categories', 'public');

            // replace the image url in the model to be saved in the db with the new image path
            $data['image_url'] = $newImagePath;
        }

        // if database operation fails, revert back to old image path
        try {
            DB::beginTransaction();
            $category->update($data);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            if($newImagePath) {
                Storage::disk('public')->delete($newImagePath);
            }
            throw $e;
        }

        // only delete old image path if a new one has been generated
        if ($newImagePath && $oldImage) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted.');
    }
}
