@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <!-- Book Details Section -->
        <div class="row g-4 mb-5">
            <!-- Book Image -->
            <div class="col-lg-5">
                <div class="position-sticky" style="top: 20px;">
                    <div class="rounded-4 overflow-hidden shadow-sm bg-white">
                        <img src="{{ asset('storage/' . $book->cover_image_url)}}" alt="{{ $book->title }}" class="img-fluid w-100">
                    </div>
                </div>
            </div>

            <!-- Book Information -->
            <div class="col-lg-7">
                <div class="mb-2 text-muted small text-uppercase">{{ $book->category->name }}</div>
                <h1 class="fw-bold mb-3">{{ $book->title }}</h1>
                <p class="text-muted mb-3">by <span class="text-dark">{{ $book->author }}</span></p>

                <!-- Rating Stars -->
                <div class="mb-4">
                    <x-display-rating-stars :rating="$book->getAverageRating()" :review-count="$book->reviewsCount()"/>
                </div>

                <!-- Price -->
                <div class="mb-2">
                    <span class="fs-2 fw-bold text-primary">${{ number_format($book->price, 2) }}</span>
                </div>

                <!-- Stock Status -->
                <div class="mb-4">
                    <x-stock-badge
                        :status="$book->stock_quantity > 0"
                        />
                </div>

                <!-- Quantity and Add to Cart -->
                <form class="mb-4 d-flex align-items-center gap-3" method="POST" action="">
                    @csrf
                    <div class="input-group shadow-sm" style="width: 180px;">
                        <button class="btn btn-outline-secondary" type="button" onclick="decrementQty()">-</button>
                        <input type="number" name="quantity" id="qty" class="form-control text-center fw-bold" value="1" min="1" max="{{ $book->stock_quantity }}">
                        <button class="btn btn-outline-secondary" type="button" onclick="incrementQty()">+</button>
                    </div>
                    <div class="flex-grow-1">
                        <x-add-to-cart-button class="w-100"/>
                    </div>
                </form>

                <!-- Book Details -->
                <div class="bg-light rounded-3 p-4">
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3">Description</h5>
                        <p class="text-muted mb-0">{{ $book->description }}</p>
                    </div>
                    <hr class="my-4 opacity-25">
                    <h5 class="fw-bold mt-4 mb-4">Product Details</h5>
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="text-muted small">ISBN</div>
                            <div class="fw-semibold">{{ $book->isbn }}</div>
                        </div>
                        <div class="col-6">
                            <div class="text-muted small">Publication Year</div>
                            <div class="fw-semibold">{{ $book->publication_year }}</div>
                        </div>
                        <div class="col-6">
                            <div class="text-muted small">Category</div>
                            <div class="fw-semibold">{{ $book->category->name }}</div>
                        </div>
                        <div class="col-6">
                            <div class="text-muted small">Author</div>
                            <div class="fw-semibold">{{ $book->author }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
{{--        <div class="row mt-5 pt-5 border-top">--}}
{{--            <div class="col-12">--}}
{{--                <h3 class="fw-bold mb-4">Customer Reviews</h3>--}}

{{--                <!-- Rating Overview -->--}}
{{--                <div class="row mb-5">--}}
{{--                    <div class="col-lg-3 text-center mb-4 mb-lg-0">--}}
{{--                        <div class="display-3 fw-bold">{{ number_format($book->getAverageRating(), 1) }}</div>--}}
{{--                        <x-display-rating-stars :rating="$book->getAverageRating()" :review-count="0"/>--}}
{{--                        <p class="text-muted mt-2">{{ $book->reviewsCount() }} {{ Str::plural('review', $book->reviewsCount()) }}</p>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-9">--}}
{{--                        <!-- Rating Breakdown -->--}}
{{--                        @for($i = 5; $i >= 1; $i--)--}}
{{--                            @php--}}
{{--                                $count = $book->reviews()->where('rating', $i)->count();--}}
{{--                                $percentage = $book->reviewsCount() > 0 ? ($count / $book->reviewsCount()) * 100 : 0;--}}
{{--                            @endphp--}}
{{--                            <div class="d-flex align-items-center mb-2">--}}
{{--                                <span class="text-nowrap me-3">{{ $i }} star</span>--}}
{{--                                <div class="progress flex-grow-1 me-3" style="height: 10px;">--}}
{{--                                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div><span class="text-muted small" style="min-width: 60px;">{{ $count }} ({{ number_format($percentage, 0) }}%)</span>--}}
{{--                            </div>--}}
{{--                        @endfor--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!-- Individual Reviews -->--}}
{{--                <div class="reviews-list">--}}
{{--                    @forelse($book->reviews()->latest()->get() as $review)--}}
{{--                        <div class="card mb-3">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="d-flex justify-content-between align-items-start mb-2">--}}
{{--                                    <div>--}}
{{--                                        <h6 class="fw-bold mb-1">{{ $review->user->name }}</h6>--}}
{{--                                        <x-display-rating-stars :rating="$review->rating" :review-count="0"/>--}}
{{--                                    </div>--}}
{{--                                    <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>--}}
{{--                                </div>--}}
{{--                                <p class="mb-0 text-muted">{{ $review->comment }}</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @empty--}}
{{--                        <div class="text-center py-5">--}}
{{--                            <p class="text-muted">No reviews yet. Be the first to review this book!</p>--}}
{{--                        </div>--}}
{{--                    @endforelse--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
@endsection

@push('scripts')
    <script>
        function incrementQty() {
            let qty = document.getElementById('qty');
            qty.value = Math.min(parseInt(qty.value) + 1, parseInt(qty.max));
        }
        function decrementQty() {
            let qty = document.getElementById('qty');
            qty.value = Math.max(parseInt(qty.value) - 1, 1);
        }
    </script>
@endpush
