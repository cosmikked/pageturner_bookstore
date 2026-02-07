<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use Illuminate\Support\Facades\Route;

// PUBLIC ROUTES
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route to role-based dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'check.role'])->name('dashboard');

// Catalog
Route::get('/catalog', [BookController::class, 'catalog'])->name('store.catalog');
Route::get('/books/{book}', [BookController::class, 'show'])->name('store.books.show');




////Public Routes (Category Browsing)
//Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
//Route::get('/category/{category}', [CategoryController::class, 'show'])->name('categories.show');
//
//// Public Routes (Book Browsing)
//Route::get('/books', [BookController::class, 'index'])->name('books.index');


//// Reviews
//Route::get('/books/{book}/reviews', [ReviewController::class, 'index'])->name('routes.index');


// AUTHENTICATED ROUTES
Route::middleware('auth')->group(function () {
    // ROLE-BASED DASHBOARD ROUTES
    Route::get('/customer/dashboard', function () {
        return view('customer.dashboard');
    })->name('customer.dashboard');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Review Routes
    Route::post('/books/{book}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // TODO: Order Controllers for both admin and customer
    // Order Routes - Customer
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

// ADMIN ROUTES
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('/categories', AdminCategoryController::class);
    Route::resource('/books', AdminBookController::class);

    // Category Management
//    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
//    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
//    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
//    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
//    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');


    // Book Management
//    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
//    Route::post('/books', [BookController::class, 'store'])->name('books.store');
//    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
//    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
//    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

});


require __DIR__.'/auth.php';
