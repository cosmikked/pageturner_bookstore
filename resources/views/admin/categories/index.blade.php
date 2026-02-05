@extends('admin.base')

@section('body')
    <x-page-header
        title="Manage Categories"
        subtitle="{{$categories->count()}} categories"
        buttonText="Add Category"
        :buttonUrl="route('admin.categories.create')"
    />

    <x-search-bar placeholder="Search categories..." />

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($categories as $category)
            <div class="col">
                <x-category-card
                    :image="$category->image_url"
                    :title="$category->name"
                    :description="$category->description"
                    :count="$category->books_count"
                    :editUrl="route('admin.categories.edit', $category)"
                    :deleteUrl="route('admin.categories.destroy', $category)"
                    :alt="$category->name . ' thumbnail'"
                    class="h-100"
                    data-id="{{ $category->id }}"
                />
            </div>
        @endforeach
    </div>
@endsection


{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--    <div class="container py-4">--}}
{{--        <div class="row">--}}
{{--            <aside class="col-12 col-md-3 mb-3 mb-md-0">--}}
{{--                @include('partials.sidebar')--}}
{{--            </aside>--}}

{{--            <main class="col-12 col-md-9">--}}
{{--                <x-page-header--}}
{{--                    title="Manage Categories"--}}
{{--                    subtitle="{{$categories->count()}} categories"--}}
{{--                    buttonText="Add Category"--}}
{{--                    :buttonUrl="route('admin.categories.create')"--}}
{{--                />--}}

{{--                <x-search-bar placeholder="Search categories..." />--}}

{{--                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">--}}
{{--                    @foreach($categories as $category)--}}
{{--                        <div class="col">--}}
{{--                            <x-category-card--}}
{{--                                :image="$category->image_url"--}}
{{--                                :title="$category->name"--}}
{{--                                :description="$category->description"--}}
{{--                                :count="$category->books_count"--}}
{{--                                :editUrl="route('admin.categories.edit', $category)"--}}
{{--                                :deleteUrl="route('admin.categories.destroy', $category)"--}}
{{--                                :alt="$category->name . ' thumbnail'"--}}
{{--                                class="h-100"--}}
{{--                                data-id="{{ $category->id }}"--}}
{{--                            />--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </main>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
