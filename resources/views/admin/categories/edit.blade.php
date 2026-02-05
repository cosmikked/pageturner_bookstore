@extends('admin.base')

@section('body')
    <x-button-back
        label="Back to Categories"
        :url="route('admin.categories.index')"
    />

    <x-page-header
        title="Edit Category"
        subtitle="Update category detail"
        buttonText="Delete Category"
        :buttonUrl="route('admin.categories.destroy', $category)"
        icon="bi-trash"
    />

    {{--    TODO: alert message for field validation errors --}}
    <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input class="form-control" type="file" id="image" name="image" accept="image/*">
            @if($category->image)
                <img src="{{ asset('storage/' . $category->image) }}" alt="Current Image" class="mt-2" style="max-width: 150px;">
            @endif
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input class="form-control" type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $category->description) }}</textarea>
        </div>
        <x-button-cancel :href="route('admin.categories.index')" />
        <x-button-save />
    </form>
@endsection

