<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <wireui:scripts />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

        <!-- Scripts -->

        @wireUiScripts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>

    </head>
    <body data-request="{{ \Illuminate\Support\Facades\Auth::id() }}" class="font-sans antialiased {{ \Illuminate\Support\Facades\Request::route()->getName() }}">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}


                <div class="fixed bottom-0 left-0 w-full">
                    <livewire:chat-bar></livewire:chat-bar>
                </div>

            </main>
        </div>

        @if(\Illuminate\Support\Facades\Auth::check())

            <script>
                window.user = {
                    'id': {{ \Illuminate\Support\Facades\Auth::id() }},
                    'type': '{{ \Illuminate\Support\Facades\Auth::user()->type }}',
                    'pendingRequest': {{ \Illuminate\Support\Facades\Auth::user()->chatRequests->where('answered', 0)->count() >= 1 ? 1 : 0 }}
                }
            </script>

        @endif

        <x-notifications position="bottom-end" />
    </body>


    <script src="https://kit.fontawesome.com/901ce00d8f.js" crossorigin="anonymous"></script>
</html>
