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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="d-flex flex-column h-100 text-light" style="background-color: #181818;">
        <div class="container">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="">
                    <div class="p-4">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <footer class="footer mt-auto py-3">
  <div class="container">
    <span class="text-muted">Place sticky footer content here.</span>
  </div>
</footer>
        </div>
    </body>
</html>
