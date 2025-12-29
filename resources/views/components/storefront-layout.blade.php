<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? $tenant->name }} | Bhandara Storefront</title>

    <!-- Tailwind Play CDN for Dynamic Theming -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '{{ $tenant->primary_color }}',
                    }
                }
            }
        }
    </script>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-900">
    <!-- Navigation -->
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-3">
                    @if($tenant->logo_path)
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($tenant->logo_path) }}" alt="{{ $tenant->name }}" class="h-8 w-auto">
                    @endif
                    <span class="font-bold text-xl tracking-tight">{{ $tenant->name }}</span>
                </div>
                
                <div class="flex items-center gap-4">
                    <button class="text-gray-500 hover:text-primary transition-colors relative">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        <span class="absolute -top-1 -right-1 bg-primary text-white text-[10px] font-bold h-4 w-4 rounded-full flex items-center justify-center">0</span>
                    </button>
                    @if(auth()->check())
                         <a href="/app" class="text-sm font-medium text-gray-600 hover:text-primary">Dashboard</a>
                    @else
                        <a href="/app/login" class="text-sm font-medium text-gray-600 hover:text-primary">Login</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <footer class="bg-white border-t border-gray-100 mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-gray-500 text-sm">© {{ date('Y') }} {{ $tenant->name }}. Powered by Bhandara.</p>
            <div class="flex gap-4">
                <a href="#" class="text-gray-400 hover:text-primary">Facebook</a>
                <a href="#" class="text-gray-400 hover:text-primary">Twitter</a>
                <a href="#" class="text-gray-400 hover:text-primary">Instagram</a>
            </div>
        </div>
    </footer>
</body>
</html>
