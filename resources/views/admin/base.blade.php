@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row">
            <aside class="col-12 col-md-3 mb-3 mb-md-0">
                @include('partials.sidebar')
            </aside>

            <main class="col-12 col-md-9">
                @yield('body')
            </main>
        </div>
    </div>
@endsection

