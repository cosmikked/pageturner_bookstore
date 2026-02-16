<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CartController extends Controller
{

    public function index() {
        $cart = session()->get('cart', []);
        // Calculate each subtotal for each book item in the cart, then get its sum
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        return view('store.cart', compact('cart', 'total'));
    }

    /**
     * Add a new book item to the cart
     *
     * @param int $bookId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request) {
        $bookId = $request->input('book_id');
        $book = Book::findOrFail($bookId);
        // Get the current cart from session, or an empty array if it doesn't exist
        $cart = session()->get('cart', []);

        // If the book is already in the cart, increase quantity
        if(isset($cart[$bookId])) {
            $cart[$bookId]['quantity']++;
        } else {
            // Otherwise, add the book to the cart
            $cart[$bookId] = [
                'id' => $bookId,
                'title' => $book->title,
                'author' => $book->author,
                'price' => $book->price,
                'image_url' => $book->cover_image_url,
                'quantity' => 1
            ];
        }

        // Save the updated cart back to the session
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Book added to cart.');
    }

    /**
     * Removes book item in the cart
     *
     * @param int $bookId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(int $bookId) {
        $cart = session()->get('cart', []);

        // If book is available in the session, remove it
        if(isset($cart[$bookId])) {
            unset($cart[$bookId]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Book removed from cart.');
        }

        // If the book is not found in the cart, inform the user
        return redirect()->back()->with('info', 'Book was not in the cart.');
    }

    /**
     * Updates item quantity of book in cart
     *
     * @param Request $request
     * @param int $bookId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $bookId) {
        $cart = session()->get('cart', []);
        $quantity = (int) $request->input('quantity', 1);



        // Ensure book exists in cart
        if(isset($cart[$bookId])) {
            // Prevents zero or negative values for quantity
            $cart[$bookId]['quantity'] = max(1, $quantity);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Cart updated successfully.');
        }

        return redirect()->back()->with('error', 'Unable to update cart.');
    }

    /**
     * Removes all items in the cart
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clear() {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Cart cleared.');
    }
}
