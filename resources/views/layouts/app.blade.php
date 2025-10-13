<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="http://unpkg.com/alpinejs" defer></script>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex flex-col">

        <!-- Navbar -->
        <nav class="bg-white border-b border-gray-200 shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <a href="{{ url('/') }}" class="flex items-center text-xl font-bold text-blue-600">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                        <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                            <a href="{{ route('riab.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-700 hover:text-blue-600">
                                RIAB
                            </a>
                            <a href="{{ route('riab.create') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-700 hover:text-blue-600">
                                Tambah
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center">
                        @auth
                            <span class="text-sm text-gray-600 mr-4">Halo, {{ Auth::user()->nama ?? Auth::user()->username }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:underline">Login</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Header -->
        @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main class="flex-grow">
            {{ $slot ?? '' }}
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 py-4 text-center text-sm text-gray-600">
            &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
        </footer>
    </div>
</body>
</html>
