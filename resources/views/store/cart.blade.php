@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-3">Your Shopping Cart</h1>
        <div class="text-start mb-4">
            <a href="{{ route('store.catalog') }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-left me-2"></i>Continue Shopping
            </a>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <!-- Cart Items -->
                <div class="card mb-4">
                    <div class="card-body">
                        @php
                            $cart = session('cart', []);
                            $subtotal = 0;
                        @endphp
                        @forelse($cart as $bookId => $item)
                            @php
                                $itemTotal = $item['price'] * $item['quantity'];
                                $subtotal += $itemTotal;
                            @endphp
                            <div class="row cart-item mb-3">
                                <div class="col-md-3">
                                    <img src="{{ $item['image_url'] ?? 'https://via.placeholder.com/100' }}" alt="{{ $item['title'] }}" class="img-fluid rounded">
                                </div>
                                <div class="col-md-5">
                                    <h5 class="card-title">{{ $item['title'] }}</h5>
                                    <p class="text-muted">Author: {{ $item['author'] }}</p>
                                </div>
                                <div class="col-md-2">
                                    <form action="{{ route('store.cart.update', $bookId) }}" method="POST" class="d-flex cart-qty-form">
                                        @csrf
                                        @method('PATCH')
                                        <button type="button" class="btn btn-outline-secondary btn-sm qty-decrement">-</button>
                                        <input style="max-width:100px" type="text" name="quantity" class="form-control form-control-sm text-center quantity-input" value="{{ $item['quantity'] }}">
                                        <button type="button" class="btn btn-outline-secondary btn-sm qty-increment">+</button>
                                    </form>
                                </div>
                                <div class="col-md-2 text-end">
                                    <p class="fw-bold">${{ number_format($itemTotal, 2) }}</p>
                                    <form action="{{ route('store.cart.remove', $bookId) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <hr>
                        @empty
                            <p>Your cart is empty.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                @php
                    $shipping = $subtotal > 0 ? 10.00 : 0.00;
                    $total = $subtotal + $shipping;
                @endphp
                <div class="card cart-summary">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Order Summary</h5>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Subtotal</span>
                            <span>${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Shipping</span>
                            <span>${{ number_format($shipping, 2) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <strong>Total</strong>
                            <strong>${{ number_format($total, 2) }}</strong>
                        </div>
                        <button class="btn btn-primary w-100" {{ $subtotal == 0 ? 'disabled' : '' }}>Proceed to Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.cart-qty-form').forEach(function(form) {
            const input = form.querySelector('.quantity-input');
            form.querySelector('.qty-decrement').onclick = function() {
                let val = parseInt(input.value) || 1;
                if (val > 1) input.value = val - 1;
                form.submit();
            };
            form.querySelector('.qty-increment').onclick = function() {
                let val = parseInt(input.value) || 1;
                input.value = val + 1;
                form.submit();
            };
        });
    </script>
@endpush
