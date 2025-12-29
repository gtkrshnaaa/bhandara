@extends('layouts.public')

@section('title', $product->name)

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <!-- Breadcrumb -->
    <nav class="mb-8 text-sm">
        <ol class="flex items-center gap-2 text-slate-500">
            <li><a href="{{ route('storefront.index', $tenant->slug) }}" class="hover:text-brand-600">Home</a></li>
            <li>/</li>
            @if($product->category)
                <li><a href="{{ route('storefront.category', [$tenant->slug, $product->category->slug]) }}" class="hover:text-brand-600">{{ $product->category->name }}</a></li>
                <li>/</li>
            @endif
            <li class="text-slate-900 font-semibold">{{ $product->name }}</li>
        </ol>
    </nav>

    <!-- Product Detail -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
        <!-- Product Image -->
        <div class="aspect-square rounded-2xl bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-32 h-32 text-slate-400">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
            </svg>
        </div>

        <!-- Product Info -->
        <div>
            <h1 class="text-4xl font-bold text-slate-900 mb-4">{{ $product->name }}</h1>
            
            @if($product->category)
                <p class="text-sm text-slate-500 mb-6">{{ $product->category->name }}</p>
            @endif

            <div class="mb-6">
                <span class="text-4xl font-bold text-brand-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
            </div>

            @if($product->description)
                <div class="mb-8">
                    <h3 class="font-semibold text-slate-900 mb-2">Description</h3>
                    <p class="text-slate-600 leading-relaxed">{{ $product->description }}</p>
                </div>
            @endif

            <!-- Stock & SKU -->
            <div class="mb-8 space-y-2">
                <div class="flex items-center gap-3">
                    <span class="text-sm font-semibold text-slate-700">Stock:</span>
                    @if($product->stock > 10)
                        <span class="text-sm text-green-600 font-semibold">In Stock ({{ $product->stock }})</span>
                    @elseif($product->stock > 0)
                        <span class="text-sm text-orange-600 font-semibold">Low Stock ({{ $product->stock }} left)</span>
                    @else
                        <span class="text-sm text-red-600 font-semibold">Out of Stock</span>
                    @endif
                </div>
                
                @if($product->sku)
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-semibold text-slate-700">SKU:</span>
                        <code class="text-sm text-slate-600 bg-slate-100 px-2 py-1 rounded">{{ $product->sku }}</code>
                    </div>
                @endif
            </div>

            <!-- Add to Cart (Coming Soon) -->
            <div class="flex gap-4">
                <button 
                    class="flex-1 bg-brand-600 text-white font-bold py-4 px-8 rounded-xl hover:bg-brand-700 transition shadow-lg disabled:opacity-50 disabled:cursor-not-allowed"
                    {{ $product->stock == 0 ? 'disabled' : '' }}
                >
                    {{ $product->stock == 0 ? 'Out of Stock' : 'Add to Cart (Coming Soon)' }}
                </button>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="border-t border-slate-200 pt-12">
            <h2 class="text-2xl font-bold text-slate-900 mb-6">You might also like</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                    <a href="{{ route('storefront.product', [$tenant->slug, $relatedProduct->slug]) }}" 
                       class="group bg-white rounded-2xl border border-slate-200 overflow-hidden hover:shadow-xl transition">
                        <div class="aspect-square bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-16 h-16 text-slate-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                            </svg>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-slate-900 group-hover:text-brand-600 transition text-sm line-clamp-2 mb-2">
                                {{ $relatedProduct->name }}
                            </h3>
                            <p class="text-lg font-bold text-brand-600">
                                Rp {{ number_format($relatedProduct->price, 0, ',', '.') }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

</div>

@endsection
