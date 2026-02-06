<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

        <!-- DataTables -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        @stack('scripts')
    </head>

    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @unless(request()->routeIs('admin.*'))
                @include('layouts.navigation')
            @endunless

            <!-- Page Content -->
            <main class="main-content">
                @yield('content')
            </main>

{{--            @include('partials.footer')--}}
        </div>

    @stack('scripts')
    </body>
</html>
