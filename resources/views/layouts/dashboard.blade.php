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
</head>

<body class="bg-gray-100 text-gray-800 font-sans">

    <aside
        class="group peer fixed left-0 h-full w-16 bg-white shadow-lg transition-all duration-300 hover:w-64 overflow-x-hidden z-40">
        <nav class="h-full">
            <ul class="space-y-2 p-2">
                <li>
                    <a href="{{ url('/dashboard') }}"
                        class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100">
                        <div
                            class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center text-white
                                  bg-gray-700">
                            D
                        </div>
                        <span
                            class="ml-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                            Dashboard
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/dashboard/products') }}"
                        class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100">
                        <div
                            class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center text-white
                                  bg-gray-700">
                            P
                        </div>
                        <span
                            class="ml-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                            Products
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-gray-100">
                        <div
                            class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center text-white
                                  bg-gray-700">
                            CV
                        </div>
                        <span
                            class="ml-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
                            Culture Vessel
                        </span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <main class="py-6 min-h-screen ml-16 transition-all duration-300 peer-hover:ml-64">
        <header class="sticky top-0 mx-4 mb-6 bg-white/80 shadow-lg rounded-full backdrop-blur-sm z-40">
            <nav>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <img src="{{ asset('assets/images/bitbio-logotype-no_tagline-color-positive-RGB.webp') }}"
                                alt="Dashboard Logo" class="h-5 w-auto"><span class="text-2xl font-bold mx-3">-</span>
                            <div class="text-xl font-semibold text-gray-800">Dashboard</div>
                        </div>

                        <div class="flex items-center">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="cursor-pointer bg-red-500 text-gray-50 hover:bg-red-700 px-4 py-1 rounded-lg font-semibold">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <div class="max-w-7xl mx-auto px-4"> <!-- Added pt-16 for header spacing -->
            @yield('content')
        </div>
    </main>
</body>

</html>
