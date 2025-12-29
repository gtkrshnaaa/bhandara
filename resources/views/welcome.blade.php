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
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05);
        }
        .animate-float { animation: float 6s ease-in-out infinite; }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        indigo: {
                            50: '#eef2ff',
                            500: '#6366f1',
                            600: '#4f46e5',
                            900: '#312e81',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="antialiased bg-slate-50 text-slate-900 min-h-screen relative overflow-x-hidden selection:bg-indigo-500 selection:text-white">

    <!-- Geometric Background Pattern -->
    <div class="fixed inset-0 z-0 opacity-40 pointer-events-none" style="background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 32px 32px;"></div>
    
    <!-- Ambient Gradients -->
    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute -top-[10%] left-[20%] w-[30%] h-[30%] bg-blue-200/40 rounded-full blur-[100px] animate-float"></div>
        <div class="absolute top-[20%] right-[10%] w-[40%] h-[40%] bg-indigo-200/40 rounded-full blur-[100px] animate-float" style="animation-delay: 2s;"></div>
    </div>
    
    <div class="relative z-10 flex flex-col min-h-screen">
        <!-- Header -->
        <header class="w-full py-4 px-6 lg:px-12 flex justify-between items-center bg-white/60 backdrop-blur-xl sticky top-0 border-b border-white z-50">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-slate-900 shadow-lg shadow-indigo-200/50 flex items-center justify-center font-bold text-white text-xl">B</div>
                <span class="font-bold text-xl tracking-tighter text-slate-900">Bhandara</span>
            </div>
            <nav class="hidden md:flex gap-10 text-sm font-semibold text-slate-500">
                <a href="#" class="hover:text-indigo-600 transition-colors">Platform</a>
                <a href="#" class="hover:text-indigo-600 transition-colors">Solutions</a>
                <a href="#" class="hover:text-indigo-600 transition-colors">Developers</a>
            </nav>
            <div class="flex gap-4 items-center">
                <a href="{{ route('login') }}" class="hidden sm:block px-5 py-2.5 text-sm font-bold text-slate-600 hover:text-indigo-600 transition-colors">Sign In</a>
                <a href="{{ route('register') }}" class="px-6 py-2.5 text-sm font-bold bg-slate-900 text-white rounded-full hover:bg-slate-800 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">Start Free</a>
            </div>
        </header>

        <!-- Hero Content -->
        <main class="flex-grow flex flex-col items-center justify-center text-center px-4 sm:px-6 lg:px-8 py-20 relative">
            
            <!-- Badge -->
            <div class="group cursor-default inline-flex items-center gap-3 px-2 py-2 pr-4 rounded-full bg-white border border-slate-200 shadow-sm mb-10 hover:border-indigo-200 transition-all">
                <span class="bg-indigo-100 text-indigo-700 text-[10px] font-bold px-2 py-1 rounded-full uppercase tracking-wider">New</span>
                <span class="text-xs font-semibold text-slate-600 group-hover:text-indigo-600 transition-colors">Bhandara v1.0 is now live</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 text-slate-400 group-hover:translate-x-1 transition-transform">
                  <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
                </svg>
            </div>

            <h1 class="text-5xl md:text-[5rem] font-bold tracking-tight mb-8 text-slate-900 leading-[1.05] max-w-5xl">
                Commerce Infrastructure for <br class="hidden md:block">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-600 bg-[length:200%_auto] animate-[gradient_3s_linear_infinite]">Sovereign Brands.</span>
            </h1>
            
            <p class="text-lg md:text-xl text-slate-500 max-w-2xl mx-auto mb-16 leading-relaxed">
                Complete control over your inventory, logistics, and payments. The only platform designed for the post-platform era.
            </p>

            <!-- Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-6xl mx-auto px-4 perspective-1000">
                <!-- Card 1: Super Admin -->
                <a href="{{ route('admin.dashboard') }}" class="group glass-panel p-8 rounded-[2rem] hover:bg-white transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-indigo-500/10 text-left relative overflow-hidden h-full flex flex-col">
                    <div class="absolute top-0 right-0 p-8 opacity-[0.03] group-hover:opacity-10 transition-opacity">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-32 h-32 text-indigo-900 transform group-hover:rotate-12 transition-transform">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                          <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                        </svg>
                    </div>
                    <div class="relative z-10 flex flex-col h-full">
                        <div class="w-16 h-16 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-8 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300 shadow-sm border border-indigo-100/50">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-3">Super Admin</h3>
                        <p class="text-slate-500 leading-relaxed text-sm">System-wide orchestration. Manage tenants, verify global transactions, and oversee platform health.</p>
                        <div class="mt-auto pt-8 flex items-center text-indigo-600 font-bold text-sm">
                            Access Control Plane 
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform">
                              <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Card 2: Merchant -->
                <a href="{{ route('merchant.dashboard') }}" class="group glass-panel p-8 rounded-[2rem] hover:bg-white transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-blue-500/10 text-left relative overflow-hidden h-full flex flex-col">
                     <div class="absolute top-0 right-0 p-8 opacity-[0.03] group-hover:opacity-10 transition-opacity">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-32 h-32 text-blue-900 transform group-hover:rotate-12 transition-transform">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72m-13.5 8.65h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .415.336.75.75.75Z" />
                        </svg>
                    </div>
                    <div class="relative z-10 flex flex-col h-full">
                        <div class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mb-8 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300 shadow-sm border border-blue-100/50">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                               <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72m-13.5 8.65h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .415.336.75.75.75Z" />
                            </svg>
                        </div>
                         <h3 class="text-2xl font-bold text-slate-900 mb-3">Merchant App</h3>
                        <p class="text-sm text-slate-500 leading-relaxed">The command center for your business. Manage catalogs, orders, customers, and finance in one place.</p>
                        <div class="mt-auto pt-8 flex items-center text-blue-600 font-bold text-sm">
                            Manage Dashboard
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform">
                              <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Card 3: Sample Store -->
                <a href="/u/nexus-gear" class="group glass-panel p-8 rounded-[2rem] hover:bg-white transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-emerald-500/10 text-left relative overflow-hidden h-full flex flex-col">
                     <div class="absolute top-0 right-0 p-8 opacity-[0.03] group-hover:opacity-10 transition-opacity">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-32 h-32 text-emerald-900 transform group-hover:rotate-12 transition-transform">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </div>
                    <div class="relative z-10 flex flex-col h-full">
                        <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-8 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300 shadow-sm border border-emerald-100/50">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                               <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                            </svg>
                        </div>
                         <h3 class="text-2xl font-bold text-slate-900 mb-3">Live Storefront</h3>
                        <p class="text-sm text-slate-500 leading-relaxed">Experience what your customers see. A blazing fast, themeable storefront ready for transactions.</p>
                        <div class="mt-auto pt-8 flex items-center text-emerald-600 font-bold text-sm">
                            View Demo Store
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform">
                              <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
        </main>

        <footer class="w-full py-8 text-center bg-white border-t border-slate-100 text-slate-400 text-sm">
            <p>&copy; {{ date('Y') }} Bhandara Inc. Crafted in Indonesia.</p>
        </footer>
    </div>
</body>
</html>
