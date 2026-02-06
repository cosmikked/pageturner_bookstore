@extends('admin.base')

@section('body')
    <x-button-back
        label="Back to Books"
        :url="route('admin.books.index')"
    />

    <x-page-header
        title="Edit Book"
        subtitle="Update book details"
    />

    {{--    TODO: alert message for field validation errors --}}
    <form class="bg-white p-4 rounded shadow-sm" action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <!-- Cover Image Section -->
        <div class="mb-4">
            <h5>Cover Image</h5>
            <div class="row">
                <div class="col-md-3">
                    <div class="border border-dashed rounded p-4 text-center">
                        <div class="mb-3">
                            <img id="coverPreview" src="{{ asset('storage/' . $book->cover_image_url) }}" alt="Cover Preview" style="width: 100px; height: 150px; object-fit: cover; display: block; margin: 0 auto 10px;">
                        </div>
                        <label for="image" class="form-label text-muted">Upload Image</label>
                        <input class="form-control" type="file" id="image" name="image" accept="image/*">
                    </div>
                </div>
                <div class="col-md-9">
                    <p class="mb-1"><strong>Recommended:</strong> 600x900px (2:3 ratio)</p>
                    <p class="mb-1"><strong>Maximum file size:</strong> 2MB</p>
                    <p class="mb-0"><strong>Supported formats:</strong> JPG, PNG, WebP</p>
                </div>
            </div>
        </div>

        <!-- Basic Information Section -->
        <div class="mb-4">
            <h5>Basic Information</h5>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="title" class="form-label">Title *</label>
                    <input class="form-control" type="text" id="title" name="title" placeholder="Enter book title" value="{{ old('title', $book->title) }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="author" class="form-label">Author *</label>
                    <input class="form-control" type="text" id="author" name="author" placeholder="Enter author name" value="{{ old('author', $book->author) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="category" class="form-label">Category *</label>
                    <select class="form-control" id="category" name="category_id" required>
                        <option value="">Select category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $book->category_id) == $category->id ? 'selected' : ''}}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="isbn" class="form-label">ISBN *</label>
                    <input class="form-control" type="text" id="isbn" name="isbn" placeholder="978-0000000000" value="{{ old('isbn', $book->isbn) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="publication_year" class="form-label">Publication Year *</label>
                    <input class="form-control" type="number" id="publication_year" name="publication_year" placeholder="e.g. 2024" min="1000" max="9999" value="{{ old('publication_year', $book->publication_year) }}" required>
                </div>
            </div>
        </div>

        <!-- Stock & Quantity Section -->
        <div class="mb-4">
            <h5>Price & Quantity</h5>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="price" class="form-label">Price (Php) *</label>
                    <input class="form-control" type="number" step="0.01" id="price" name="price" placeholder="0.00" min="0" value="{{ old('price', $book->price) }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="stock" class="form-label">Stock Quantity *</label>
                    <input class="form-control" type="number" id="stock" name="stock_quantity" placeholder="0" min="0" value="{{ old('stock_quantity', $book->stock_quantity) }}" required>
                </div>
            </div>
        </div>

        <!-- Description Section -->
        <div class="mb-4">
            <h5>Description</h5>
            <div class="mb-3">
                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter a detailed description of the book...">
                    {{ old('description', $book->description) }}
                </textarea>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex gap-2">
            <x-button-cancel :href="route('admin.books.index')" />
            <x-button-save />
        </div>
    </form>
@endsection


@push('scripts')
    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                document.getElementById('coverPreview').src = URL.createObjectURL(file);
            }
        });
    </script>
@endpush

