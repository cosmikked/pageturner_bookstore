@extends('layouts.app')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @php
        $shippingFee = config('shipping.flat_rate');
        $grandTotal = $total + $shippingFee;
    @endphp
    <div class="container py-4">
        <div class="py-4 text-center">
            <h2>Checkout</h2>
        </div>
        <div class="row g-5 pb-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Your cart</span>
                    <span class="badge bg-primary rounded-pill">{{ count($cartItems) }}</span>
                </h4>
                <ul class="list-group mb-3">
                    @foreach($cartItems as $cartItem)
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">{{ $cartItem['title'] }}</h6>
                            <small class="text-body-secondary">{{ $cartItem['author'] }}</small><small class="text-body-secondary">Quantity: {{ $cartItem['quantity'] }}</small>
                        </div>
                        <span class="text-body-secondary">₱{{ $cartItem['price'] * $cartItem['quantity']}}</span>
                    </li>
                    @endforeach
                    
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Subtotal</span>
                        <span>₱{{ number_format($total, 2) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Shipping Fee</span>
                        <span>₱{{ number_format($shippingFee, 2) }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between fw-bold">
                        <span>Total (PHP)</span>
                        <strong>₱{{ number_format($grandTotal, 2) }}</strong>
                    </li>
                </ul>

            </div>
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Billing address</h4>
                <form class="needs-validation" method="POST" action="{{ route('store.checkout.store') }}"novalidate>
                    @csrf
                    <!-- Hidden input for shipping fee -->
                    <input type="hidden" name="shipping_fee" value="{{ $shippingFee }}">
                    <input type="hidden" name="grand_total" value="{{ $grandTotal }}">

                    <!-- Hidden input for cart items (as JSON) -->
                    <input type="hidden" name="cart_items" value='@json($cartItems)'>

                    <div class="row g-3">
                        <div class="col-12">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="fullName" id="fullName" placeholder="" value="{{ $fullName }}" required />
                            <div class="invalid-feedback">
                                Valid full name is required.
                            </div>
                        </div>
                        
                        <div class="col-6">
                            <label for="street" class="form-label">Street</label>
                            <input type="text" class="form-control" name="street" id="street" placeholder="1234 Main St" required />
                            <div class="invalid-feedback">
                                Please enter your street.
                            </div>
                        </div>
                                                <div class="col-6">
                            <label for="baranggay" class="form-label">Barangay</label>
                            <input type="text" class="form-control" name="baranggay" id="baranggay" placeholder="1234 Main St" required />
                            <div class="invalid-feedback">
                                Please enter your barangay.
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label for="city" class="form-label">City</label>
                            <select class="form-select" name="city" id="city" required>
                                <option value="">Choose...</option>
                                <option>United States</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid city.
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="province" class="form-label">Province</label>
                            <select class="form-select" name="province" id="province" required>
                                <option value="">Choose...</option>
                                <option>California</option>
                            </select>
                            <div class="invalid-feedback">
                                Please provide a valid province.
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="zip" class="form-label">Zip</label>
                            <input type="text" class="form-control" name="postal_code" id="zip" placeholder="" required />
                            <div class="invalid-feedback">Zip code required.</div>
                        </div>
                    </div>


                    <hr class="my-4" />
                    <button class="w-100 btn btn-primary btn-lg" type="submit">
                        Continue to checkout
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection()