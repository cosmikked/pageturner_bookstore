@extends('admin.base')

@section('body')
    <x-page-header
        title="Manage Books"
        subtitle="{{$books->count()}} books in catalog"
        buttonText="Add Book"
        :buttonUrl="route('admin.books.create')"
    />

    <x-search-bar placeholder="Search categories..." />

    <div>
        <table class="table align-middle">
            <thead class="table-light">
                <tr>
                    <th>Book</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($books as $book)
                <tr>
                    <!-- Book -->
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('storage/' . $book->cover_image_url) }}"
                                 alt="{{ $book->title }}"
                                 class="rounded me-3"
                                 style="width:48px; height:64px; object-fit:cover;">
                            <div>
                                <div class="fw-semibold">{{ $book->title }}</div>
                                <div class="text-muted small">{{ $book->author }}</div>
                            </div>
                        </div>
                    </td>

                    <!-- Category -->
                    <td>
                        <span class="badge bg-light text-dark">{{ $book->category->name ?? '—' }}</span>
                    </td>

                    <!-- Price -->
                    <td>
                        <span class="fw-bold">${{ number_format($book->price, 2) }}</span>
                    </td>

                    <!-- Stock -->
                    <td>
                        <span class="badge bg-success bg-opacity-25 text-success">
                    {{ $book->stock_quantity }} in stock</span>
                    </td>

                    <!-- Action Buttons -->
                    <td>
                        <x-button-edit :href="route('admin.books.edit', $book)" color="text-primary"/>
                        <x-button-delete :action="route('admin.books.destroy', $book)" color="text-danger" />
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection


{{--@push('scripts')--}}
{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            $('#books-table').DataTable({--}}
{{--                pageLength: 10,--}}
{{--                order: [[1, 'asc']], // Sort by title (column index 1)--}}
{{--                columnDefs: [--}}
{{--                    { orderable: false, targets: [0, 4] } // Disable sorting on Cover and Actions columns--}}
{{--                ]--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}
