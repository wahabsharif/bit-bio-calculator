<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Cell Seeding Calculator')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

</head>

<body class="bg-gray-100 text-gray-800 font-sans">
    <header class="fixed top-0 left-0 right-0 z-50 bg-white shadow rounded-b-3xl">
        <div class="max-w-2xl mx-auto px-4 py-4 text-center">
            <h1 class="text-xl uppercase font-bold">Cell Seeding Calculator</h1>
            <p class="text-sm text-gray-600">
                This calculator has been designed to help scientists determine how many cells and how much volume is
                needed for seeding those cells. Follow the steps below and get your results instantly!
            </p>
        </div>
    </header>

    <main class="pt-30 py-6 min-h-screen">
        <div class="max-w-7xl mx-auto px-4">
            @yield('content')
        </div>
    </main>


    <footer class="bg-white text-center border-t border-gray-200 rounded-t-3xl">
        <div class="max-w-7xl mx-auto p-2 space-y-1 text-sm text-gray-500">
            <p>Please note that this calculator has been developed by <a href="bit.bio"
                    class="text-indigo-700 hover:underline">bit.bio</a> and provides standard guidance.</p>
            <div class="flex justify-center space-x-6 items-center">
                <p><a href="bit.bio" class="text-indigo-700 hover:underline">bit.bio</a> © {{ date('Y') }}. All
                    rights reserved.
                </p>
                <p>For technical support, please contact: <a href="mailto:technical@bit.bio"
                        class="text-indigo-700 hover:underline">technical@bit.bio</a></p>
            </div>
        </div>
    </footer>
</body>

</html>
