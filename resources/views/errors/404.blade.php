<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Page Not Found</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="text-center bg-gray-50 p-10 rounded-xl shadow-lg">
        <h1 class="text-9xl tracking-widest font-bold text-red-500">404</h1>
        <p class="text-2xl mt-4 text-gray-700">Oops! Page not found.</p>
        <p class="mt-2 text-gray-500">The page you are looking for doesn't exist or has been moved.</p>
        <a href="{{ url('/') }}"
            class="mt-6 inline-block bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition">
            Go Home
        </a>
    </div>
</body>

</html>
