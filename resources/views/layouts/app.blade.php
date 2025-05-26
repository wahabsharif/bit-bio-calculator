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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

</head>

<body class>
    <div class="grad-bg no-print w-full h-4 top-0 left-0 z-50"></div>

    <div class="container mx-auto">
        <!-- Header -->
        <header>
            <div class="mx-auto flex flex-col items-start py-3 pb-8">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <img src="{{ asset('assets/images/bitbio-logo.png') }}" alt="Dashboard Logo"
                        class="md:h-10 h-11 w-auto p-logo">
                </div>

                <!-- Content -->
                <div class="text-left">
                    <h1 class="md:text-[1.8rem] text-[1.6rem] mb-4 p-heading mt-3 font-bold">Cell seeding
                        calculator
                    </h1>
                    <p class="no-print text-sm max-w-sm md:max-w-lg lg:max-w-3xl">
                        This calculator helps scientists to quickly determine how much cell stock solution and culture
                        media
                        is needed for
                        seeding cells in a variety of different culture vessels. By following this simple step-by-step
                        guide,
                        you can get your
                        results instantly!
                    </p>
                </div>

                <!-- Placeholder for symmetry (hidden on small) -->
                <div class="hidden md:block flex-shrink-0 w-20"></div>
            </div>
        </header>

        <!-- Main Content -->
        <main>
            <div class="mx-auto">
                @yield(section: 'content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white mt-10 hidden md:block text-start border-gray-200 pb-12">
            <div class="mx-auto py-2 text-xs md:text-sm text-black">
                <p class="pb-2 md:pb-0">
                    Please note that this calculator has been developed by
                    <a class="!text-black" href="https://bit.bio">bit.bio</a> and provides standard
                    guidance.
                </p>
                <div class="m-auto">
                    <p>
                        <a class="!text-black" href="https://bit.bio">bit.bio</a> ©
                        {{ date('Y') }}.
                        All
                        rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
