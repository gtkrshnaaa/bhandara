<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? $tenant->name }}</title>

    <!-- Tailwind Play CDN for Dynamic Theming -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
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
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* Smooth scrolling */
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="antialiased bg-white text-gray-900 font-sans selection:bg-primary selection:text-white">
    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center gap-3">
                    @if($tenant->logo_path)
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($tenant->logo_path) }}" alt="{{ $tenant->name }}" class="h-8 w-auto">
                    @else
                        <!-- Text Logo Fallback -->
                         <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-white font-bold">
                            {{ substr($tenant->name, 0, 1) }}
                        </div>
                    @endif
                    <span class="font-bold text-xl tracking-tight text-gray-900">{{ $tenant->name }}</span>
                </div>
                
                <div class="flex items-center gap-6">
                     <div class="hidden md:flex gap-6 text-sm font-medium text-gray-500">
                        <a href="#" class="hover:text-black transition-colors">Shop</a>
                        <a href="#" class="hover:text-black transition-colors">Collections</a>
                        <a href="#" class="hover:text-black transition-colors">About</a>
                    </div>
                    <div class="w-px h-6 bg-gray-200 hidden md:block"></div>
                    
                    <div class="flex items-center gap-4">
                        <button class="relative p-2 hover:bg-gray-100 rounded-full transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                            <span class="absolute top-1 right-1 bg-primary text-white text-[9px] font-bold h-3.5 w-3.5 rounded-full flex items-center justify-center border border-white">2</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <footer class="bg-gray-900 text-white pt-20 pb-10 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-1 md:col-span-2">
                    <h4 class="text-2xl font-bold mb-6">{{ $tenant->name }}</h4>
                    <p class="text-gray-400 max-w-sm mb-6">
                        Experience the best in class products, curated with passion and delivered with care. Your sovereign commerce destination.
                    </p>
                </div>
                <div>
                    <h5 class="font-bold mb-4">Shop</h5>
                    <ul class="space-y-3 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">New Arrivals</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Best Sellers</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Discount</a></li>
                    </ul>
                </div>
                 <div>
                    <h5 class="font-bold mb-4">Support</h5>
                    <ul class="space-y-3 text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Shipping</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Returns</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-gray-500">
                <p>&copy; {{ date('Y') }} {{ $tenant->name }}. All rights reserved.</p>
                <div class="flex items-center gap-2">
                    <span>Powered by</span>
                    <span class="font-bold text-white">Bhandara</span>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
