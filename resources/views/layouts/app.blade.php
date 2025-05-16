<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Laravel Chat')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    <!-- Add other required CSS files here -->
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Optionally, include a sidebar component if needed -->
        <!-- @include('layouts.sidebar') -->

        <div class="flex-1">


            <main class="p-4">
                @yield('content') <!-- The content from your views will be injected here -->
            </main>
        </div>
    </div>
</body>
</html>
