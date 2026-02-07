<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('store.books.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('store.books.show');
    }

    public function catalog(Request $request)
    {
        $categories = Category::all();
        $books = Book::with('category')->get();
        return view('store.catalog', compact('categories', 'books'));
    }

}
