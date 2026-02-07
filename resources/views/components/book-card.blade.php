@props([
    'image_url' => '',
    'category' => '',
    'title' => '',
    'author' => '',
    'ratings' => '',
    'review_count' => '',
    'price' => '',
    'in_stock' => '',
    'url' => null,
    'book_id' => null
])

<div class="card shadow rounded-4 h-100" style="height: 420px; width: 18rem;">
    @if($url)
        <a href="{{ $url }}" class="text-decoration-none text-reset">
            <img src="{{ $image_url }}" alt="{{ $title }}" class="card-img-top rounded-top-4" style="height: 180px; object-fit: cover;">
        </a>
    @else
        <img src="{{ $image_url }}" alt="{{ $title }}" class="card-img-top rounded-top-4" style="height: 180px; object-fit: cover;">
    @endif
    <div class="card-body d-flex flex-column">
        <div>
            <div class="mb-2 text-uppercase text-danger fw-semibold small">{{ $category }}</div>
            <h5 class="card-title fw-bold mb-1">{{ $title }}</h5>
            <p class="card-text text-muted mb-2">by {{ $author }}</p>
            <div class="d-flex align-items-center mb-2">
                @for ($i = 1; $i <= 5; $i++)
                    <span class="me-1" style="color: {{ $i <= $ratings ? '#ffc107' : '#e4e5e9' }};">&#9733;</span>
                @endfor
                <span class="text-muted small ms-2">({{ $review_count }})</span>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-3">
                <span class="fw-bold fs-4">₱{{ number_format($price, 2) }}</span>
                <x-stock-badge :status="$in_stock"/>
            </div>
        </div>
        <div class="mt-auto">
            <form method="POST" action="{{ route('store.cart.add') }}" class="add-to-cart-form">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book_id }}">
                <x-add-to-cart-button/>
            </form>
        </div>
    </div>
</div>

