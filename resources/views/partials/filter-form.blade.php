<div class="card p-3" style="max-width: 300px;">
    <form method="GET" action="{{ route('store.catalog') }}">
        <h5 class="mb-3">Filters</h5>

        {{-- Category Checkboxes --}}
        <h6 class="mb-3 fw-bold">Categories</h6>
        <div class="mb-3">
            @foreach($categories as $category)
                <div class="form-check mb-2">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="categories[]"
                        value="{{ $category->id }}"
                    {{ in_array($category->id, $filters['categories'] ?? []) ? 'checked' : '' }}"
                    >
                    <label class="form-check-label">
                        {{ $category->name }}
                    </label>
                </div>
            @endforeach
        </div>

        {{-- Price Range --}}
        <h6 class="mb-3 fw-bold">Price Range</h6>
        <div class="row g-2 mb-3">
            <div class="col">
                <input
                    type="number"
                    class="form-control"
                    name="min_price"
                    value="{{ $filters['min_price'] ?? 0 }}"
                    placeholder="Min"
                >
            </div>
            <div class="col">
                <input
                    type="number"
                    class="form-control"
                    name="max_price"
                    value="{{ $filters['max_price'] ?? 100 }}"
                    placeholder="Max"
                >
            </div>
        </div>

        {{-- Reviews Filter --}}
        <h6 class="mb-3 fw-bold">Rating</h6>
        <div class="mb-3">
            @for($i = 4; $i > 1; $i--)
                <div class="form-check mb-1">
                    <input
                        class="form-check-input"
                        type="radio"
                        name="min_rating"
                        value="{{ $i }}"
                        {{ (isset($filters['min_rating']) && $filters['min_rating'] == $i) ? 'checked' : '' }}
                    >
                    <label class="form-check-label">
                        &ge; {{ $i }} Stars
                    </label>
                </div>
            @endfor
        </div>

        {{-- Stock Filter --}}
        <div class="form-check mb-3">
            <input
                class="form-check-input"
                type="checkbox"
                name="in_stock_only"
                value="1"
            {{ ($filters['in_stock_only'] ?? false) ? 'checked' : '' }}"
            >
            <label class="form-check-label fw-bold">
                In Stock Only
            </label>
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-3">Apply</button>
    </form>
</div>
