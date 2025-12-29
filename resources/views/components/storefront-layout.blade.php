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
<body class="antialiased bg-white text-slate-900 font-sans selection:bg-primary selection:text-white">
    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white/90 backdrop-blur-xl border-b border-slate-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-24 items-center">
                <div class="flex items-center gap-4">
                    @if($tenant->logo_path)
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($tenant->logo_path) }}" alt="{{ $tenant->name }}" class="h-10 w-auto">
                    @else
                        <!-- Text Logo Fallback -->
                         <div class="w-10 h-10 bg-slate-900 rounded-full flex items-center justify-center text-white font-bold text-lg">
                            {{ substr($tenant->name, 0, 1) }}
                        </div>
                    @endif
                    <span class="font-bold text-2xl tracking-tight text-slate-900">{{ $tenant->name }}</span>
                </div>
                
                <div class="flex items-center gap-8">
                     <div class="hidden md:flex gap-8 text-sm font-bold text-slate-500 uppercase tracking-wider">
                        <a href="#" class="hover:text-slate-900 transition-colors">Catalog</a>
                        <a href="#" class="hover:text-slate-900 transition-colors">Journal</a>
                        <a href="#" class="hover:text-slate-900 transition-colors">Info</a>
                    </div>
                    <div class="w-px h-8 bg-slate-200 hidden md:block"></div>
                    
                    <button id="menu-btn" class="md:hidden p-2 -mr-2 text-slate-900 z-50 relative">
                        <!-- Hamburger -->
                        <svg id="menu-icon-open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5" />
                        </svg>
                        <!-- Close X -->
                        <svg id="menu-icon-close" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 hidden">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    
                    <button class="relative group">
                        <div class="p-3 bg-slate-50 rounded-full hover:bg-slate-900 hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </div>
                        <span class="absolute -top-1 -right-1 bg-primary text-white text-[10px] font-bold h-5 w-5 rounded-full flex items-center justify-center border-2 border-white shadow-sm">2</span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <footer class="bg-white border-t border-slate-100 pt-24 pb-12 mt-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start gap-12 mb-20">
                <div class="max-w-md">
                    <h4 class="text-3xl font-bold mb-6 tracking-tight text-slate-900">{{ $tenant->name }}</h4>
                    <p class="text-slate-500 leading-relaxed">
                        Redefining the standard of digital commerce. We provide a seamless experience for those who appreciate quality and design.
                    </p>
                </div>
                <div class="flex gap-16">
                    <div>
                        <h5 class="font-bold mb-6 text-slate-900 uppercase text-xs tracking-widest">Explore</h5>
                        <ul class="space-y-4 text-slate-500 text-sm font-medium">
                            <li><a href="#" class="hover:text-primary transition-colors">Catalog</a></li>
                            <li><a href="#" class="hover:text-primary transition-colors">New Arrivals</a></li>
                            <li><a href="#" class="hover:text-primary transition-colors">Featured</a></li>
                        </ul>
                    </div>
                     <div>
                        <h5 class="font-bold mb-6 text-slate-900 uppercase text-xs tracking-widest">Connect</h5>
                        <ul class="space-y-4 text-slate-500 text-sm font-medium">
                            <li><a href="#" class="hover:text-primary transition-colors">Instagram</a></li>
                            <li><a href="#" class="hover:text-primary transition-colors">Twitter</a></li>
                            <li><a href="#" class="hover:text-primary transition-colors">Support</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-slate-100 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-slate-400 font-medium">
                <p>&copy; {{ date('Y') }} {{ $tenant->name }}.</p>
                <div class="flex items-center gap-2">
                    <span>Powered by</span>
                    <span class="font-bold text-slate-900">Bhandara</span>
                </div>
            </div>
        </div>
    </footer>
    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu" class="fixed inset-0 z-40 bg-white transform translate-x-full transition-transform duration-300 md:hidden flex flex-col pt-24 px-6">
        <a href="#" class="text-2xl font-bold mb-8 text-slate-900">Catalog</a>
        <a href="#" class="text-2xl font-bold mb-8 text-slate-900">Journal</a>
        <a href="#" class="text-2xl font-bold mb-8 text-slate-900">Info</a>
        <div class="mt-auto pb-12">
            <p class="text-sm text-slate-400">&copy; {{ date('Y') }} {{ $tenant->name }}</p>
        </div>
    </div>

    <script>
        const menuBtn = document.getElementById('menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const openIcon = document.getElementById('menu-icon-open');
        const closeIcon = document.getElementById('menu-icon-close');
        let isMenuOpen = false;

        menuBtn.addEventListener('click', () => {
            isMenuOpen = !isMenuOpen;
            if (isMenuOpen) {
                mobileMenu.classList.remove('translate-x-full');
                document.body.style.overflow = 'hidden';
                openIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            } else {
                mobileMenu.classList.add('translate-x-full');
                document.body.style.overflow = '';
                openIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
