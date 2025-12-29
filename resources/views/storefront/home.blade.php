<x-storefront-layout :tenant="$tenant">
    
    <!-- Hero Section -->
    <div class="relative bg-gray-900 text-white overflow-hidden">
        <div class="absolute inset-0 opacity-50 bg-gradient-to-r from-primary to-purple-900"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32 flex flex-col items-center text-center">
            <h1 class="text-4xl md:text-6xl font-bold tracking-tight mb-4">
                Welcome to <span class="text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-300">{{ $tenant->name }}</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-200 max-w-2xl mb-8">
                Discover our premium collection of products curated just for you. Quality and satisfaction guaranteed.
            </p>
            <a href="#products" class="px-8 py-3 bg-white text-primary font-bold rounded-full shadow-lg hover:bg-gray-100 transition-transform transform hover:-translate-y-1">
                Shop Now
            </a>
        </div>
    </div>

    <!-- Product Grid -->
    <div id="products" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Featured Products</h2>
            <div class="flex gap-2">
                <!-- Simple Category Filter Placeholder -->
                <button class="px-3 py-1 text-sm rounded-full bg-primary text-white">All</button>
                <button class="px-3 py-1 text-sm rounded-full bg-gray-100 text-gray-600 hover:bg-gray-200">New Arrivals</button>
            </div>
        </div>

        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach($products as $product)
                    <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden flex flex-col">
                        <!-- Image -->
                        <div class="relative aspect-square overflow-hidden bg-gray-100">
                            @if($product->images && count($product->images) > 0)
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($product->images[0]) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                </div>
                            @endif
                            
                            <!-- Badges -->
                            @if($product->is_featured)
                                <span class="absolute top-2 left-2 bg-yellow-400 text-yellow-900 text-xs font-bold px-2 py-1 rounded-md shadow-sm">
                                    Featured
                                </span>
                            @endif

                             <!-- Quick Add Overlay -->
                            <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button class="bg-white text-gray-900 px-4 py-2 rounded-full font-medium hover:bg-primary hover:text-white transition-colors transform translate-y-4 group-hover:translate-y-0 duration-300">
                                    View Details
                                </button>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-5 flex-1 flex flex-col">
                            <div class="mb-2">
                                <span class="text-xs font-medium text-gray-400 uppercase tracking-wider">{{ $product->category->name ?? 'General' }}</span>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-primary transition-colors line-clamp-1">
                                {{ $product->name }}
                            </h3>
                           
                            
                            <div class="mt-auto flex items-center justify-between pt-4 border-t border-gray-50">
                                 <p class="text-xl font-bold text-gray-900">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>
                                <button class="p-2 rounded-full bg-gray-50 text-gray-600 hover:bg-primary hover:text-white transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-24 bg-gray-50 rounded-3xl border border-dashed border-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto text-gray-300 mb-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900">No products found</h3>
                <p class="text-gray-500">Check back later for new arrivals.</p>
            </div>
        @endif
    </div>
</x-storefront-layout>
