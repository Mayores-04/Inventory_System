<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>
    
    {{-- TailwindCSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Additional Styles --}}
    <style>
        .nav-link {
            @apply px-4 py-2 text-gray-600 hover:text-blue-600 transition;
        }
    </style>
</head>
<body class="bg-gray-100">

    {{-- Navbar --}}
    <nav class="bg-white shadow-md p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-blue-600 text-xl font-bold">School Portal</a>
            <div>
                <a href="{{ route('home') }}" class="nav-link">Home</a>
                <a href="{{ route('about') }}" class="nav-link">About</a>
                <a href="{{ route('contact') }}" class="nav-link">Contact</a>
                <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-700">
                    Login
                </a>
            </div>
        </div>
    </nav>

    {{-- Main Content Area --}}
    <main class="container mx-auto p-6">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-200 text-center p-4 mt-6">
        <p class="text-gray-600">&copy; {{ date('Y') }} School Management System. All rights reserved.</p>
    </footer>

</body>
</html>
