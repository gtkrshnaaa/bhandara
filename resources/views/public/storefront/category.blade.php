@extends('layouts.public')

@section('title', $category->name)

@section('content')

<!-- Breadcrumb -->
<div class="bg-slate-50 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="text-sm">
            <ol class="flex items-center gap-2 text-slate-500">
                <li><a href="{{ route('storefront.index', $tenant->slug) }}" class="hover:text-brand-600">Home</a></li>
                <li>/</li>
                <li class="text-slate-900 font-semibold">{{ $category->name }}</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Category Header -->
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-slate-900 mb-2">{{ $category->name }}</h1>
        <p class="text-slate-500">{{ $products->total() }} products found</p>
    </div>
</section>

<!-- Sidebar & Products Grid -->
<section class="pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <!-- Sidebar Categories -->
            <aside class="lg:col-span-1">
                <div class="bg-white rounded-xl border border-slate-200 p-6">
                    <h3 class="font-semibold text-slate-900 mb-4">Categories</h3>
                    <ul class="space-y-2">
                        @foreach($categories as $cat)
                            <li>
                                <a href="{{ route('storefront.category', [$tenant->slug, $cat->slug]) }}" 
                                   class="flex items-center justify-between px-3 py-2 rounded-lg {{ $cat->id == $category->id ? 'bg-brand-50 text-brand-600 font-semibold' : 'text-slate-600 hover:bg-slate-50' }} transition">
                                    <span>{{ $cat->name }}</span>
                                    <span class="text-xs px-2 py-1 rounded-full bg-slate-100">{{ $cat->products_count }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            <!-- Products Grid -->
            <div class="lg:col-span-3">
                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
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

                    <!-- Pagination -->
                    @if($products->hasPages())
                        <div class="mt-8">
                            {{ $products->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center py-16">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-24 h-24 mx-auto text-slate-300 mb-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                        </svg>
                        <h3 class="text-2xl font-bold text-slate-600 mb-2">No products in this category</h3>
                        <p class="text-slate-500 mb-6">Check out other categories</p>
                        <a href="{{ route('storefront.index', $tenant->slug) }}" 
                           class="inline-block px-6 py-3 bg-brand-600 text-white font-semibold rounded-xl hover:bg-brand-700 transition">
                            Browse All Products
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</section>

@endsection
