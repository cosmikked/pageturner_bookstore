@props([
    'image_url' => '',
    'category' => '',
    'title' => '',
    'author' => '',
    'ratings' => '',
    'review_count' => '',
    'price' => '',
    'in_stock' => '',
    'url' => null
])

@if($url)
    <a href="{{ $url }}" class="text-decoration-none text-reset">
@endif
    <div class="card shadow rounded-4" style="width: 18rem;">
        <img src="{{ $image_url }}" alt="{{ $title }}" class="card-img-top rounded-top-4" style="height: 180px; object-fit: cover;">
        <div class="card-body">
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
                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 fs-6">{{ $in_stock ? 'In Stock' : 'Out of Stock' }}</span>
            </div>
            <button class="btn btn-danger w-100 d-flex align-items-center justify-content-center gap-2 fs-5">
                <i class="bi bi-cart"></i>
                Add to Cart
            </button>
        </div>
    </div>
@if($url)
    </a>
@endif

