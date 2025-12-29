<x-storefront-layout :tenant="$tenant">
    
    <!-- Hero Section -->
    <div class="relative bg-white pt-24 pb-16 md:pt-32 md:pb-24 overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-[500px] bg-gradient-to-b from-primary/5 to-transparent pointer-events-none"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center z-10">
             <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-xs font-bold text-primary mb-6 tracking-wide uppercase">
                New Collection {{ date('Y') }}
            </div>
            <h1 class="text-5xl md:text-7xl font-extrabold text-gray-900 tracking-tight leading-none mb-6">
                Redefining <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-purple-600">Commerce.</span>
            </h1>
            <p class="text-xl text-gray-500 max-w-2xl mx-auto mb-10 leading-relaxed font-light">
                Explore a curated selection of products designed for the modern lifestyle. Quality, aesthetics, and performance in one place.
            </p>
            <div class="flex justify-center gap-4">
                <a href="#products" class="px-8 py-3.5 bg-gray-900 text-white font-semibold rounded-full hover:bg-gray-800 transition-all shadow-xl shadow-gray-200 hover:shadow-2xl hover:-translate-y-1">
                    Shop Collection
                </a>
            </div>
        </div>
    </div>

    <!-- Product Grid -->
    <div id="products" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="flex items-end justify-between mb-12 border-b border-gray-100 pb-6">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">Trending Now</h2>
                <p class="text-gray-500 mt-1">Handpicked for you.</p>
            </div>
            <div class="hidden md:flex gap-3">
                 <button class="px-5 py-2 rounded-full border border-gray-200 text-sm font-medium hover:border-black hover:bg-black hover:text-white transition-all">All</button>
                 <button class="px-5 py-2 rounded-full border border-transparent text-gray-500 text-sm font-medium hover:text-black">Electronics</button>
                 <button class="px-5 py-2 rounded-full border border-transparent text-gray-500 text-sm font-medium hover:text-black">Accessories</button>
            </div>
        </div>

        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-y-12 gap-x-8">
                @foreach($products as $product)
                    <div class="group cursor-pointer">
                        <div class="relative aspect-[4/5] overflow-hidden rounded-2xl bg-gray-100 mb-5 relative">
                             @if($product->images && count($product->images) > 0)
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($product->images[0]) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                   <!-- Placeholder SVG -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                </div>
                            @endif
                            
                            <!-- Add to Cart Button appearing on hover -->
                            <button class="absolute bottom-4 left-4 right-4 bg-white/90 backdrop-blur-sm text-black py-3 rounded-xl font-bold opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 hover:bg-black hover:text-white shadow-lg">
                                Add to Cart — Rp {{ number_format($product->price, 0, ',', '.') }}
                            </button>
                        </div>
                        
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 group-hover:text-primary transition-colors">{{ $product->name }}</h3>
                                <p class="text-sm text-gray-500 mt-1">{{ $product->category->name ?? 'Uncategorized' }}</p>
                            </div>
                            <!-- Price moved to button for cleaner look, or kept here subtler -->
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-32 bg-gray-50 rounded-3xl border border-dashed border-gray-200">
                <p class="text-gray-500 text-lg">Inventory is currently empty.</p>
            </div>
        @endif
    </div>
</x-storefront-layout>
