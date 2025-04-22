<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Bit Bio Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

</head>

<body class="bg-gray-100 text-gray-800 font-sans">
    <header class="fixed top-0 left-0 right-0 z-50 bg-white shadow rounded-b-3xl">
        <nav>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="text-xl font-semibold text-gray-800">Dashboard</div>
                    </div>
                    <div class="flex items-center">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class=" cursor-pointer text-gray-600 hover:text-gray-800">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="pt-30 py-6 min-h-screen">
        <div class="max-w-7xl mx-auto px-4">
            @yield('content')
        </div>
    </main>
</body>

</html>
