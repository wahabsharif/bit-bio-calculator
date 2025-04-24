<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Bit Bio Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon-32x32.webp') }}">
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>

<body class="bg-gray-100 text-gray-800 font-sans">

    <aside class="fixed left-0 h-full w-44 hidden md:block bg-white rounded-r-xl shadow-lg overflow-x-hidden z-40">
        <nav class="h-full">
            <ul class="space-y-2 p-2">
                <li>
                    <a href="{{ url('/dashboard') }}"
                        class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100">
                        <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center">
                            <x-ri-dashboard-fill />
                        </div>
                        <span class="ml-3 whitespace-nowrap">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/dashboard/products') }}"
                        class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100">
                        <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center">
                            <x-carbon-carbon-for-ibm-product />
                        </div>
                        <span class="ml-3 whitespace-nowrap">Products</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/dashboard/culture-vessels') }}"
                        class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100">
                        <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center">
                            <x-healthicons-f-blood-vessel />
                        </div>
                        <span class="ml-3 whitespace-nowrap">Culture Vessel</span>
                    </a>
                </li>
            </ul>
            <ul class="absolute bottom-0 border-t-2 border-gray-700 left-0 w-full p-2">
                <li>
                    <a href="#" {{-- <a href="{{ url('/dashboard/settings') }}" --}}
                        class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100">
                        <div class="flex-shrink-0 w-8 h-8 flex items-center justify-center">
                            <x-eva-settings />
                        </div>
                        <span class="ml-3 whitespace-nowrap">Settings</span>
                    </a>
                </li>
        </nav>
    </aside>


    <main class="py-4 min-h-screen md:ml-48 transition-all duration-300">
        <header class="sticky top-2 mx-4 mb-6 bg-white/80 shadow-lg rounded-full backdrop-blur-sm z-40">
            <nav>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between py-2 px-2">
                        <div class="flex items-center">
                            <img src="{{ asset('assets/images/bitbio-logotype-no_tagline-color-positive-RGB.webp') }}"
                                alt="Dashboard Logo" class="md:h-6 h-4 w-auto"><span
                                class="text-2xl hidden md:block font-bold mx-3">-</span>
                            @php
                                $segments = request()->segments();
                                $crumbs = array_map(function ($segment) {
                                    return ucwords(str_replace('-', ' ', $segment));
                                }, $segments);
                                $title = implode(' - ', $crumbs);
                            @endphp

                            <div class="text-xl hidden md:block font-semibold text-gray-800">
                                {{ $title }}
                            </div>

                        </div>
                        <div x-data="{ isOpen: false }" class="relative">
                            <!-- Hamburger Button -->
                            <button @click="isOpen = !isOpen" class="flex items-center space-x-1 md:hidden">
                                <!-- Hamburger Icon when closed -->
                                <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                                <!-- X Icon when open -->
                                <svg x-show="isOpen" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>

                            <!-- Mobile Menu Dropdown -->
                            <div x-show="isOpen" x-cloak style="display: none;" @click.away="isOpen = false"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute -right-4 mt-4 w-36 rounded-md shadow-lg bg-white py-1">

                                <a href="{{ url('/dashboard') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Dashboard
                                </a>
                                <a href="{{ url('/dashboard/products') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Products
                                </a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Culture Vessel
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <div class="p-2">
                                        <button type="submit"
                                            class="block w-full tracking-widest px-4 rounded-md text-center py-2 text-sm text-gray-100 bg-red-500">
                                            Logout
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="items-center hidden md:flex">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="cursor-pointer flex items-center bg-red-500 text-gray-50 hover:bg-red-700 px-4 py-1 rounded-lg font-semibold">
                                    <x-tabler-logout /> <span class="mx-1">Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <div class="max-w-7xl mx-auto px-4">
            @yield('content')
        </div>
    </main>

</body>

</html>
