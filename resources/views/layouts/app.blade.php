<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Bit Bio - Calculator')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon-32x32.webp') }}">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

</head>

<body class="bg-gray-100 text-gray-800 font-sans">
    <!-- Header -->
    <header id="app-header" class="fixed inset-x-0 top-0 z-50 bg-white shadow-md">
        <div id="header-inner"
            class="container mx-auto flex flex-col md:flex-row items-center justify-between px-4 md:px-6 py-3 transition-all">
            <!-- Logo -->
            <div class="flex-shrink-0 p-2">
                <img src="{{ asset('assets/images/bitbio-logotype-no_tagline-color-positive-RGB.webp') }}"
                    alt="Dashboard Logo" class="h-4 md:h-6 w-auto">
            </div>

            <!-- Content -->
            <div id="header-content" class="mt-2 md:mt-0 text-center">
                <h1 class="text-md md:text-xl uppercase font-bold">Bit Bio Calculator</h1>
                <p class="text-xs md:text-sm text-gray-600 max-w-sm md:max-w-md lg:max-w-2xl">
                    This calculator has been designed to help scientists determine how many cells and how much volume is
                    needed for seeding those cells. Follow the steps below and get your results instantly!
                </p>
            </div>

            <!-- Placeholder for symmetry (hidden on small) -->
            <div class="hidden md:block flex-shrink-0 w-20"></div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pt-36 md:pt-24 pb-6 min-h-screen">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white text-center border-t border-gray-200">
        <div class="container mx-auto px-4 md:px-6 py-4 space-y-2 text-xs md:text-sm text-gray-500">
            <p>
                Please note that this calculator has been developed by
                <a href="https://bit.bio" class="text-indigo-700 hover:underline">bit.bio</a> and provides standard
                guidance.
            </p>
            <div class="flex flex-col md:flex-row justify-center items-center space-y-1 md:space-y-0 md:space-x-6">
                <p>
                    <a href="https://bit.bio" class="text-indigo-700 hover:underline">bit.bio</a> © {{ date('Y') }}.
                    All
                    rights reserved.
                </p>
                <p>
                    For technical support, please contact:
                    <a href="mailto:technical@bit.bio" class="text-indigo-700 hover:underline">technical@bit.bio</a>
                </p>
            </div>
        </div>
    </footer>
</body>
<script>
    (function() {
        const content = document.getElementById('header-content');
        const headerInner = document.getElementById('header-inner');
        const isSmall = () => window.matchMedia('(max-width: 768px)').matches;
        let ticking = false;

        function onScroll() {
            if (!isSmall()) {
                // Always show on larger screens
                content.classList.remove('hidden');
                headerInner.classList.replace('py-1', 'py-3');
                return;
            }

            const scrolled = window.scrollY > 20;
            if (scrolled) {
                content.classList.add('hidden');
                headerInner.classList.replace('py-3', 'py-1');
            } else {
                content.classList.remove('hidden');
                headerInner.classList.replace('py-1', 'py-3');
            }
        }

        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    onScroll();
                    ticking = false;
                });
                ticking = true;
            }
        });

        // Reset on resize/orientation change
        window.addEventListener('resize', onScroll);
        // Initial check
        onScroll();
    })();
</script>

</html>
