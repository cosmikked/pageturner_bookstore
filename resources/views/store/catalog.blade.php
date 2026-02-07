@extends('layouts.app')

@section('content')
    {{-- Banner --}}
    <div class="bg-dark text-white py-5 mb-4">
        <div class="container">
            <h1 class="display-4 fw-bold">Browse Our Collection</h1>
            <p class="lead">Discover thousands of titles across every genre. Use filters to find your perfect read.</p>
        </div>
    </div>

    {{-- Search and Sort --}}
    <div class="container mb-1">
        <div class="row justify-content-center">
            <div class="col-12">
                @include('partials.search-sort')
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            {{-- Filters Sidebar --}}
            <div class="col-md-3 mb-4">
                <div class="sticky-top" style="top: 86px; z-index: 1010;">
                    @include('partials.filter-form')
                </div>
            </div>
            {{-- Book Cards Grid --}}
            <div class="col-md-9">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="fw-bold">{{ $books->count() }} books found</span>
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 justify-content-center">
                    @foreach($books as $book)
                        <div class="col d-flex">
                            <x-book-card
                                :image_url="$book->cover_image_url"
                                :category="$book->category->name"
                                :title="$book->title"
                                :author="$book->author"
                                :ratings="$book->rating"
                                :review_count="$book->reviews()->count()"
                                :price="$book->price"
                                :in_stock="$book->stock_quantity > 0"
                                :url="route('store.books.show', $book)"
                            />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
