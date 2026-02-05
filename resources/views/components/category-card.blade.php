@props([
    'image' => null,
    'title' => '',
    'description' => '',
    'url' => null,
    'count' => null,
    'editUrl' => null,
    'deleteUrl' => null,
    'alt' => ''
])

<div {{ $attributes->merge(['class' => 'card mb-3 h-100 shadow-sm rounded-3 overflow-hidden']) }}>
    <div class="position-relative">
        @if($image)
            <img src="{{ asset('storage/' . $image) }}" alt="{{ $alt ?: $title }}" class="card-img-top" style="height:160px;object-fit:cover;" loading="lazy">
        @else
            <div class="bg-secondary bg-opacity-10" style="height:160px;"></div>
        @endif

        <div class="position-absolute top-0 end-0 m-2 d-flex gap-2">
            @if($editUrl)
                <a href="{{ $editUrl }}" class="btn btn-sm btn-light rounded-circle shadow-sm" aria-label="Edit {{ $title }}">
                    <i class="bi bi-pencil"></i>
                </a>
            @endif

            @if($deleteUrl)
                <form method="POST" action="{{ $deleteUrl }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-light rounded-circle shadow-sm" aria-label="Delete {{ $title }}">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            @endif
        </div>
    </div>

    <div class="card-body">
        <div class="d-flex align-items-start justify-content-between mb-2">
            <h5 class="card-title mb-0">{{ $title }}</h5>
            @if($count !== null)
                <span class="badge rounded-pill bg-light text-dark small">{{ $count }} books</span>
            @endif
        </div>

        @if($description)
            <p class="card-text text-muted mb-6">{{ $description }}</p>
        @endif

        @if($url)
            <a href="{{ $url }}" class="stretched-link" aria-label="Open {{ $title }}"></a>
        @endif
    </div>
</div>
