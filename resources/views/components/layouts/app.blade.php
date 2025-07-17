<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="pt-BR" class="{{ str_contains(request()->url(), '/admin') ? 'dark' : '' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen">
<div class="flex flex-col min-h-screen">
    <!-- Header -->
    <header class="bg-gray-900 shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-white">CarSearch</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-8">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 shadow mt-auto">
        <div class="container mx-auto px-4 py-4 text-center text-white">
            &copy; {{ date('Y') }} CarSearch. Todos os direitos reservados.
        </div>
    </footer>
</div>

@livewireScripts
</body>
</html>
