<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bhandara - Sovereign Commerce Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9', // Sky 500
                            600: '#0284c7',
                            900: '#0c4a6e',
                            950: '#082f49',
                        }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="antialiased bg-slate-950 text-white min-h-screen relative overflow-x-hidden selection:bg-brand-500 selection:text-white">

    <!-- Background Gradients -->
    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-brand-500/20 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
    </div>
    
    <div class="relative z-10 flex flex-col min-h-screen">
        <!-- Header -->
        <header class="w-full py-6 px-6 lg:px-12 flex justify-between items-center glass border-b border-white/5">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-brand-500 to-purple-600 flex items-center justify-center font-bold text-lg">B</div>
                <span class="font-bold text-xl tracking-wide">Bhandara</span>
            </div>
            <nav class="hidden md:flex gap-8 text-sm font-medium text-slate-300">
                <a href="#" class="hover:text-white transition-colors">Features</a>
                <a href="#" class="hover:text-white transition-colors">Pricing</a>
                <a href="#" class="hover:text-white transition-colors">About</a>
            </nav>
            <div class="flex gap-4">
                <a href="/app/login" class="px-5 py-2 text-sm font-medium text-white hover:text-brand-200 transition-colors">Log in</a>
                <a href="/app/register" class="px-5 py-2 text-sm font-medium bg-white text-slate-900 rounded-full hover:bg-brand-50 transition-all shadow-[0_0_20px_rgba(255,255,255,0.3)] hover:shadow-[0_0_30px_rgba(255,255,255,0.5)]">Get Started</a>
            </div>
        </header>

        <!-- Hero Content -->
        <main class="flex-grow flex flex-col items-center justify-center text-center px-4 sm:px-6 lg:px-8 py-20 relative">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full glass text-xs font-medium text-brand-200 mb-8 border border-white/10">
                <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></span>
                v1.0.0 Stable Release
            </div>

            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 leading-tight">
                Sovereign Commerce <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-400 via-white to-purple-400">For The Modern Era</span>
            </h1>
            
            <p class="text-lg md:text-xl text-slate-400 max-w-2xl mx-auto mb-12">
                Empowering merchants with a private treasury. Establish your sovereign digital storefront with complete control over inventory, logistics, and finance.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-4xl mx-auto">
                <!-- Card 1: Super Admin -->
                <a href="/admin" class="group glass p-8 rounded-2xl hover:bg-white/5 transition-all duration-500 border border-white/5 hover:border-brand-500/50 hover:-translate-y-2 relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-brand-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10 flex flex-col items-center">
                        <div class="w-14 h-14 rounded-xl bg-slate-800 border border-white/10 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-500 text-brand-400">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Super Admin</h3>
                        <p class="text-sm text-slate-400">System Control Center</p>
                    </div>
                </a>

                <!-- Card 2: Merchant -->
                <a href="/app" class="group glass p-8 rounded-2xl hover:bg-white/5 transition-all duration-500 border border-white/5 hover:border-purple-500/50 hover:-translate-y-2 relative overflow-hidden">
                     <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10 flex flex-col items-center">
                        <div class="w-14 h-14 rounded-xl bg-slate-800 border border-white/10 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-500 text-purple-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72m-13.5 8.65h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .415.336.75.75.75Z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Merchant App</h3>
                        <p class="text-sm text-slate-400">Manage Your Store</p>
                    </div>
                </a>

                <!-- Card 3: Sample Store -->
                <a href="/u/nexus-gear" class="group glass p-8 rounded-2xl hover:bg-white/5 transition-all duration-500 border border-white/5 hover:border-emerald-500/50 hover:-translate-y-2 relative overflow-hidden">
                     <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative z-10 flex flex-col items-center">
                        <div class="w-14 h-14 rounded-xl bg-slate-800 border border-white/10 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-500 text-emerald-400">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Public Storefront</h3>
                        <p class="text-sm text-slate-400">Live Demo Shop</p>
                    </div>
                </a>
            </div>
        </main>

        <footer class="w-full py-6 text-center text-slate-500 text-sm border-t border-white/5 glass">
            <p>&copy; {{ date('Y') }} Bhandara Inc. Crafted for sovereignty.</p>
        </footer>
    </div>
</body>
</html>
