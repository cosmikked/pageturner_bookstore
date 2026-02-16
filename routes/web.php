<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
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

Route::prefix('/store')->name('store.')->group(function () {
    Route::get('/catalog', [BookController::class, 'catalog'])->name('catalog');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update/{book}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/delete/{book}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/checkout', [OrderController::class, 'create'])->name('checkout')->middleware('auth');
    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store')->middleware('auth');
    Route::get('/orders/{order}/success', [OrderController::class, 'success'])->name('orders.success')->middleware('auth');
});


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
});

require __DIR__.'/auth.php';
