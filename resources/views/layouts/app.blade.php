<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Bit Bio - Calculator')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon-32x32.webp') }}">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>

    <script src="{{ asset('js/validation.js') }}"></script>
    <script src="{{ asset('js/cell-checks.js') }}"></script>
    <script src="{{ asset('js/calculator.js') }}"></script>
    <script src="{{ asset('js/export.js') }}"></script>
    <script src="{{ asset('js/ui-handlers.js') }}"></script>
    <script src="{{ asset('js/tooltip.js') }}"></script>


</head>

<body class>
    <div class="grad-bg no-print w-full h-4 top-0 left-0 z-50"></div>

    <!-- Header -->
    <header class="flex container mx-auto">
        <div class="md:w-[75%] flex flex-col items-start text-left">
            <!-- Logo -->
            <div class="flex-shrink-0 mb-2">
                <img src="{{ asset('assets/images/bitbio-logo.png') }}" alt="Dashboard Logo"
                    class="w-[190px] h-[55px] p-logo">
            </div>

            <!-- Content -->
            <div class="text-left">
                <h1 class="md:text-[1.8rem] text-[32px] p-heading !my-1 !font-semibold">Cell seeding
                    calculator
                </h1>
                <p class="no-print">
                    This calculator helps scientists to quickly determine how much cell stock solution and culture media
                    is needed for seeding cells in a variety of different culture vessels. By following this simple
                    step-by-step guide, you can get your results instantly!
                </p>
            </div>

            <!-- Placeholder for symmetry (hidden on small) -->
            <div class="hidden md:block flex-shrink-0 w-20"></div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto">
        @yield(section: 'content')
    </main>

    <!-- Footer -->
    <footer class="bg-white container mx-auto mt-10 hidden md:block text-start max-w-4xl border-gray-200 pb-12">
        <div class="mx-auto py-2 text-black">
            <p class="pb-2 md:pb-0">
                Please note that this calculator has been developed by <a class="!text-black"
                    href="https://bit.bio">bit.bio</a> and provides standard guidance. By
                using this tool, you agree to our cell seeding calculator - Terms and Conditions.
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
    <script>
        // Ensure we only attach the event listeners once
        (function() {
            // Store original document title
            const originalTitle = document.title;
            let isEventListenersAttached = false;

            // Function to format date as DD-MM-YYYY
            function formatDate(date) {
                const day = String(date.getDate()).padStart(2, '0');
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const year = date.getFullYear();
                return `${day}-${month}-${year}`;
            }

            // Function to format time as H-MM AM/PM
            function formatTime(date) {
                const hours = date.getHours();
                const minutes = String(date.getMinutes()).padStart(2, '0');
                const ampm = hours >= 12 ? 'PM' : 'AM';
                const hour12 = hours % 12 || 12;
                return `${hour12}-${minutes} ${ampm}`;
            }

            // Set up the print filename functionality
            function setupPrintFilename() {
                if (isEventListenersAttached) return;
                isEventListenersAttached = true;

                // Remove any existing event listeners first
                window.removeEventListener('beforeprint', handleBeforePrint);
                window.removeEventListener('afterprint', handleAfterPrint);

                // Add event listeners with named functions for easier removal
                window.addEventListener('beforeprint', handleBeforePrint);
                window.addEventListener('afterprint', handleAfterPrint);

                // Override the PDF download functionality
                const pdfButton = document.getElementById('downloadPdf');
                if (pdfButton) {
                    // Remove existing event listeners if any
                    pdfButton.replaceWith(pdfButton.cloneNode(true));

                    // Get the button again after replacing it
                    const newPdfButton = document.getElementById('downloadPdf');
                    if (newPdfButton) {
                        newPdfButton.addEventListener('click', handlePdfDownload);
                    }
                }
            }

            // Handle before print event
            function handleBeforePrint() {
                const now = new Date();
                const formattedDate = formatDate(now);
                const formattedTime = formatTime(now);
                document.title = `bit.bio - Cell Seeding Calculation - ${formattedDate} - ${formattedTime}`;
            }

            // Handle after print event
            function handleAfterPrint() {
                document.title = originalTitle;
            }

            // Handle PDF download button click
            function handlePdfDownload(e) {
                // Get current date and time
                const now = new Date();
                const formattedDate = formatDate(now);
                const formattedTime = formatTime(now);

                // Set document title to the desired filename format
                document.title = `bit.bio - Cell Seeding Calculation - ${formattedDate} - ${formattedTime}`;

                // Print the page (which allows saving as PDF)
                window.print();

                // Reset the document title after printing with a delay to ensure it happens after print dialog is closed
                setTimeout(() => {
                    document.title = originalTitle;
                }, 100);
            }

            // Set up the event listeners when the DOM is loaded
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', setupPrintFilename);
            } else {
                setupPrintFilename();
            }
        })();
    </script>
</body>

</html>
