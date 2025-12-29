<x-storefront-layout :tenant="$tenant">
    
    <!-- Hero Section -->
    <div class="relative bg-white pt-24 pb-16 md:pt-36 md:pb-24 overflow-hidden">
        <!-- Abstract Decoration -->
        <div class="absolute -top-40 -right-40 w-[600px] h-[600px] bg-primary/5 rounded-full blur-3xl pointer-events-none"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10">
             <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-slate-50 border border-slate-100 text-xs font-bold text-slate-900 mb-8 tracking-wide uppercase">
                <span class="w-2 h-2 rounded-full bg-primary"></span>
                Collection {{ date('Y') }}
            </div>
            
            <div class="flex flex-col md:flex-row gap-12 items-end">
                <div class="flex-1">
                    <h1 class="text-6xl md:text-8xl font-black text-slate-900 tracking-tighter leading-none mb-6">
                        Wear <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-purple-600">The Future.</span>
                    </h1>
                    <p class="text-xl text-slate-500 max-w-lg mb-10 leading-relaxed font-normal">
                        Meticulously crafted essentials for the modern pioneer. Designed for longevity, engineered for comfort.
                    </p>
                    <div class="flex gap-4">
                        <a href="#products" class="px-8 py-4 bg-slate-900 text-white font-bold rounded-full hover:bg-black transition-all shadow-xl hover:-translate-y-1">
                            Explore Catalog
                        </a>
                        <a href="#" class="px-8 py-4 bg-white text-slate-900 border border-slate-200 font-bold rounded-full hover:bg-slate-50 transition-all">
                            About Us
                        </a>
                    </div>
                </div>
                <div class="hidden md:block w-1/3 pb-4">
                    <p class="text-sm font-bold text-slate-900 uppercase tracking-widest border-b border-slate-200 pb-2 mb-2">Manifesto</p>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        We believe in objects that last. Our collection is curated from the finest materials, ensuring that every piece you own tells a story of quality and resilience.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Grid -->
    <div id="products" class="bg-slate-50/50 py-24 border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-16">
                <h2 class="text-3xl font-bold text-slate-900 tracking-tight">Curated Selection</h2>
                <div class="hidden md:flex gap-2 bg-white p-1.5 rounded-full border border-slate-100 shadow-sm">
                     <button class="px-5 py-2 rounded-full bg-slate-900 text-white text-sm font-bold shadow-md">All</button>
                     <button class="px-5 py-2 rounded-full text-slate-500 text-sm font-bold hover:bg-slate-50 transition-colors">Digital</button>
                     <button class="px-5 py-2 rounded-full text-slate-500 text-sm font-bold hover:bg-slate-50 transition-colors">Physical</button>
                </div>
            </div>

            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-y-16 gap-x-8">
                    @foreach($products as $product)
                        <div class="group cursor-pointer">
                            <div class="relative aspect-[3/4] overflow-hidden rounded-[2rem] bg-white mb-6 border border-slate-100 shadow-sm group-hover:shadow-xl group-hover:shadow-primary/5 transition-all duration-500">
                                 @if($product->images && count($product->images) > 0)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($product->images[0]) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-slate-50 text-slate-300">
                                       <!-- Placeholder SVG -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-16 h-16">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                    </div>
                                @endif
                                
                                <div class="absolute bottom-5 right-5 z-20">
                                     <button class="w-12 h-12 rounded-full bg-white text-slate-900 flex items-center justify-center shadow-lg hover:bg-slate-900 hover:text-white transition-all transform hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 leading-tight mb-1 group-hover:text-primary transition-colors">{{ $product->name }}</h3>
                                <div class="flex justify-between items-center mt-2">
                                     <span class="text-sm font-medium text-slate-400 capitalize">{{ $product->category->name ?? 'Selection' }}</span>
                                     <span class="px-3 py-1 rounded-full bg-slate-100 text-xs font-bold text-slate-900">
                                         Rp {{ number_format($product->price, 0, ',', '.') }}
                                     </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-32 bg-white rounded-[2rem] border border-slate-100 border-dashed">
                    <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-slate-400">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                        </svg>
                    </div>
                    <p class="text-slate-900 font-bold mb-1">Collection Empty</p>
                    <p class="text-slate-500 text-sm">Check back soon for new releases.</p>
                </div>
            @endif
        </div>
    </div>
</x-storefront-layout>
