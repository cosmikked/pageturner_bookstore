<form method="GET" action="{{ route('store.catalog') }}">
    <div class="bg-white rounded-3 p-3 mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="flex-grow-1">
                <div class="input-group">
                <span class="input-group-text bg-transparent border-0">
                    <i class="bi bi-search text-secondary"></i>
                </span>
                    <input
                        type="text"
                        class="form-control border-0 bg-light"
                        name="search"
                        placeholder="Search by title or author..."
                        value="{{ request('search') }}"
                        autocomplete="off"
                    >
                </div>
            </div>
            <div>
                <select class="form-select border-0 bg-light" name="sort">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Arrivals</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to
                        High
                    </option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to
                        Low
                    </option>
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">
                    Search
                </button>
            </div>
        </div>
    </div>
</form>
