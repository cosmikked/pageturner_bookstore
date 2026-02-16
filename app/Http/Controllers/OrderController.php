<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function create() {
        $cartItems = session()->get('cart');
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cartItems));
        $fullName = Auth::user()->name;

        return view('store.orders.checkout', compact('cartItems','total', 'fullName'));
    }

    public function success(Order $order) {
        $order->load('customer');
        $order->load('orderItems.book');
        return view('store.orders.success', compact('order'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'fullName' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'baranggay' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
        ]);
        
        $customerId = Auth::user()->id;
        $status = 'pending';
        $referenceNumber = 'ORD-' . date('YmdHis') . '-' . rand(1000, 9999);
        $shippingFee = config('shipping.flat_rate');

        // get order items 
        $orderItems = session()->get('cart', []);
        if (empty($orderItems)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $subTotal = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $orderItems));
        $total_amount = $subTotal + $shippingFee;

        $data['customer_id'] = $customerId;
        $data['status'] = $status;
        $data['total_amount'] = $total_amount;
        $data['reference_number'] = $referenceNumber;
        unset($data['fullName']);

        try {
            DB::beginTransaction();
            $order = Order::create($data);
            $orderId = $order->id;

            foreach($orderItems as $orderItem) {
                OrderItem::create([
                    'order_id' => $orderId,
                    'book_id' => $orderItem['id'],
                    'quantity' => $orderItem['quantity'],
                    'unit_price' => $orderItem['price'],
                ]);
            }

            DB::commit();
            session()->forget('cart');
            return redirect(route('store.orders.success', [$order]));
        } catch (\Throwable $e){
            DB::rollBack();
            return redirect()->back()->with('error', 'Unable to place order.' . $e);
        }
    }
}
