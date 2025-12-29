@extends('layouts.public')

@section('title', 'Home')

@section('content')

<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-brand-50 to-purple-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-slate-900 mb-4">
                Welcome to {{ $tenant->name }}
            </h1>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                Discover our curated collection of premium products
            </p>
        </div>
    </div>
</section>

<!-- Featured Products -->
@if($featuredProducts->count() > 0)
<section class="py-16" id="products">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-slate-900">Featured Products</h2>
                <p class="text-slate-500 mt-1">Hand-picked favorites just for you</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featuredProducts as $product)
                <a href="{{ route('storefront.product', [$tenant->slug, $product->slug]) }}" 
                   class="group bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-xl transition">
                    <!-- Product Image Placeholder -->
                    <div class="aspect-square bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-20 h-20 text-slate-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                        </svg>
                    </div>

                    <!-- Product Info -->
                    <div class="p-5">
                        <h3 class="font-bold text-slate-900 group-hover:text-brand-600 transition mb-2 line-clamp-2">
                            {{ $product->name }}
                        </h3>
                        <p class="text-2xl font-bold text-brand-600">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                        @if($product->stock < 10 && $product->stock > 0)
                            <p class="text-xs text-orange-600 mt-2">Only {{ $product->stock }} left!</p>
                        @elseif($product->stock == 0)
                            <p class="text-xs text-red-600 mt-2">Out of stock</p>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Categories -->
@if($categories->count() > 0)
<section class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-slate-900 mb-8">Browse by Category</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($categories as $category)
                <a href="{{ route('storefront.category', [$tenant->slug, $category->slug]) }}" 
                   class="bg-white rounded-xl p-6 text-center hover:shadow-lg transition border border-slate-200 group">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-brand-50 flex items-center justify-center group-hover:bg-brand-600 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 text-brand-600 group-hover:text-white transition">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-slate-900 group-hover:text-brand-600 transition">{{ $category->name }}</h3>
                    <p class="text-sm text-slate-500 mt-1">{{ $category->products_count }} products</p>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Latest Products -->
@if($latestProducts->count() > 0)
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-slate-900 mb-8">Latest Arrivals</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($latestProducts as $product)
                <a href="{{ route('storefront.product', [$tenant->slug, $product->slug]) }}" 
                   class="group bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-xl transition">
                    <div class="aspect-square bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-20 h-20 text-slate-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                        </svg>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-slate-900 group-hover:text-brand-600 transition mb-2 line-clamp-2">
                            {{ $product->name }}
                        </h3>
                        <p class="text-2xl font-bold text-brand-600">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Empty State -->
@if($featuredProducts->count() == 0 && $latestProducts->count() == 0)
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-24 h-24 mx-auto text-slate-300 mb-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72m-13.5 8.65h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .415.336.75.75.75Z" />
        </svg>
        <h3 class="text-2xl font-bold text-slate-600 mb-2">No products yet</h3>
        <p class="text-slate-500">Check back soon for new arrivals!</p>
    </div>
</section>
@endif

@endsection
