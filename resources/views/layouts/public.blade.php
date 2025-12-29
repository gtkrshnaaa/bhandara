<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $tenant->name }} - @yield('title', 'Shop')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            DEFAULT: '{{ $tenant->primary_color ?? "#6366f1" }}',
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            500: '{{ $tenant->primary_color ?? "#6366f1" }}',
                            600: '{{ $tenant->primary_color ?? "#4f46e5" }}',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white antialiased">

    <!-- Header -->
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-xl border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="{{ route('storefront.index', $tenant->slug) }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-500 to-purple-600 shadow-lg flex items-center justify-center font-bold text-white text-lg">
                        {{ substr($tenant->name, 0, 1) }}
                    </div>
                    <span class="font-bold text-xl text-slate-900">{{ $tenant->name }}</span>
                </a>

                <!-- Navigation -->
                <nav class="hidden md:flex items-center gap-8">
                    <a href="{{ route('storefront.index', $tenant->slug) }}" 
                       class="text-sm font-semibold {{ request()->routeIs('storefront.index') ? 'text-brand-600' : 'text-slate-600 hover:text-brand-600' }} transition">
                        Home
                    </a>
                    <a href="#products" class="text-sm font-semibold text-slate-600 hover:text-brand-600 transition">Products</a>
                    <a href="#about" class="text-sm font-semibold text-slate-600 hover:text-brand-600 transition">About</a>
                </nav>

                <!-- Shopping Cart -->
                @php
                    $cartCount = 0;
                    $cart = session()->get("cart_{$tenant->id}", []);
                    foreach($cart as $qty) {
                        $cartCount += $qty;
                    }
                @endphp
                <a href="{{ route('storefront.cart.index', $tenant->slug) }}" class="relative p-2 text-slate-600 hover:text-brand-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    @if($cartCount > 0)
                        <span class="absolute -top-1 -right-1 w-5 h-5 bg-brand-600 text-white text-xs font-bold rounded-full flex items-center justify-center">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- About -->
                <div>
                    <h3 class="font-bold text-lg mb-4">{{ $tenant->name }}</h3>
                    <p class="text-slate-400 text-sm">Your trusted online shop for quality products.</p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="font-bold text-lg mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-sm text-slate-400">
                        <li><a href="{{ route('storefront.index', $tenant->slug) }}" class="hover:text-white transition">Home</a></li>
                        <li><a href="#products" class="hover:text-white transition">Products</a></li>
                        <li><a href="#about" class="hover:text-white transition">About Us</a></li>
                    </ul>
                </div>

                <!-- Powered By -->
                <div>
                    <h3 class="font-bold text-lg mb-4">Powered By</h3>
                    <p class="text-slate-400 text-sm">Built with Bhandara - Sovereign Commerce Platform</p>
                </div>
            </div>

            <div class="border-t border-slate-800 mt-8 pt-8 text-center text-sm text-slate-400">
                <p>&copy; {{ date('Y') }} {{ $tenant->name }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>
