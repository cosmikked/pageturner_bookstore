@extends('admin.base')

@section('body')
    <x-button-back
        label="Back to Categories"
        :url="route('admin.categories.index')"
    />

    <x-page-header
        title="Add New Categories"
        subtitle="Create a new book category"
    />

{{--    TODO: alert message for field validation errors --}}
    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input class="form-control" type="file" id="image" name="image" accept="image/*">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input class="form-control" type="text" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <x-button-cancel :href="route('admin.categories.index')" />
        <x-button-save />
    </form>
@endsection
