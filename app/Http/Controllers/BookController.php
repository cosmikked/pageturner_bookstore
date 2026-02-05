<?php

namespace App\Http\Controllers;

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

}
