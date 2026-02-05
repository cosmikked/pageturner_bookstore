<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@pageturner.com',
            'role' => 'admin'
        ]);

        // Create customer users
         $customers = User::factory(10)->create([
             'role' => 'customer'
         ]);

        // Create categories
        $categories = Category::factory(8)->create();

        // Create authors
        Author::factory(10)->create();

        // Create 5 books per category
        foreach($categories as $category) {
            $books = Book::factory(5)->create([
                'category_id' => $category->id
            ]);

            // Assign 1-3 authors to each book
            foreach($books as $book) {
                $authorIds = Author::inRandomOrder()->take(rand(1, 3))->pluck('id');
                $book->authors()->attach($authorIds);
            }
        }


        foreach ($customers as $customer) {
            // Create reviews for each book per customer
            foreach (Book::all() as $book) {
                Review::factory()->create([
                    'book_id' => $book->id,
                    'customer_id' => $customer->id,
                ]);
            }

            // Create orders for each customer
            $orders = Order::factory(rand(2,4))->create([
               'customer_id' => $customer->id,
            ]);

            // Create orderitem for each book and order
            foreach($orders as $order) {
                $booksForOrder = Book::inRandomOrder()->take(rand(2,5))->get();

                foreach($booksForOrder as $book) {
                    OrderItem::factory()->create([
                        'order_id' => $order->id,
                        'book_id' => $book->id
                    ]);
                }
            }
        }
    }

}
