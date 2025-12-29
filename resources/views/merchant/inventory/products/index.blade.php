@extends('layouts.merchant')

@section('title', 'Products - Inventory')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Products</h1>
            <p class="text-slate-500 mt-1">Manage your inventory catalog</p>
        </div>
        <a href="{{ route('merchant.inventory.products.create') }}" 
           class="inline-flex items-center px-6 py-3 bg-slate-900 text-white font-semibold rounded-xl hover:bg-slate-800 transition shadow-lg">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Add Product
        </a>
    </div>

    @include('components.alerts')

    <!-- Search Bar -->
    <div class="mb-6">
        <form method="GET" action="{{ route('merchant.inventory.products.index') }}" class="flex gap-4">
            <div class="flex-1 relative">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Search products by name or SKU..." 
                    class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-slate-200 focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition"
                >
            </div>
            <button type="submit" class="px-6 py-3 bg-brand-600 text-white font-semibold rounded-xl hover:bg-brand-700 transition">
                Search
            </button>
            @if(request('search'))
                <a href="{{ route('merchant.inventory.products.index') }}" class="px-6 py-3 bg-slate-100 text-slate-700 font-semibold rounded-xl hover:bg-slate-200 transition">
                    Clear
                </a>
            @endif
        </form>
    </div>

    <!-- Products Table -->
    @if($products->count() > 0)
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Product</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Category</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Price</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Stock</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Status</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-slate-600 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach($products as $product)
                            <tr class="hover:bg-slate-50 transition">
                                <!-- Product Info -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center flex-shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-slate-400">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                                            </svg>
                                        </div>
                                        <div class="min-w-0">
                                            <div class="flex items-center gap-2">
                                                <p class="font-semibold text-slate-900 truncate">{{ $product->name }}</p>
                                                @if($product->is_featured)
                                                    <span class="px-2 py-0.5 bg-yellow-100 text-yellow-700 text-xs font-bold rounded">Featured</span>
                                                @endif
                                            </div>
                                            @if($product->sku)
                                                <p class="text-xs text-slate-500 mt-0.5">SKU: {{ $product->sku }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <!-- Category -->
                                <td class="px-6 py-4">
                                    @if($product->category)
                                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-indigo-100 text-indigo-700">
                                            {{ $product->category->name }}
                                        </span>
                                    @else
                                        <span class="text-sm text-slate-400">Uncategorized</span>
                                    @endif
                                </td>

                                <!-- Price -->
                                <td class="px-6 py-4">
                                    <span class="font-bold text-slate-900">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                </td>

                                <!-- Stock -->
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $product->stock > 10 ? 'bg-green-100 text-green-700' : ($product->stock > 0 ? 'bg-orange-100 text-orange-700' : 'bg-red-100 text-red-700') }}">
                                        {{ $product->stock }} units
                                    </span>
                                </td>

                                <!-- Status -->
                                <td class="px-6 py-4">
                                    @if($product->stock > 0)
                                        <span class="inline-flex items-center gap-1 text-sm font-semibold text-green-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                                            </svg>
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 text-sm font-semibold text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z" clip-rule="evenodd" />
                                            </svg>
                                            Out of Stock
                                        </span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('merchant.inventory.products.edit', $product) }}" 
                                           class="p-2 text-slate-600 hover:text-brand-600 hover:bg-brand-50 rounded-lg transition"
                                           title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                <path d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
                                                <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('merchant.inventory.products.destroy', $product) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this product?')"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="p-2 text-slate-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                                                    title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                    <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
                <div class="px-6 py-4 border-t border-slate-200 flex items-center justify-between">
                    <div class="text-sm text-slate-500">
                        Showing <span class="font-semibold">{{ $products->firstItem() }}</span> to <span class="font-semibold">{{ $products->lastItem() }}</span> of <span class="font-semibold">{{ $products->total() }}</span> products
                    </div>
                    <div>
                        {{ $products->links() }}
                    </div>
                </div>
            @endif
        </div>
    @else
        <div class="bg-white rounded-2xl border border-slate-200 p-16 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-24 h-24 mx-auto text-slate-300 mb-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
            </svg>
            @if(request('search'))
                <h3 class="text-xl font-semibold text-slate-600 mb-2">No products found</h3>
                <p class="text-slate-500 mb-6">Try adjusting your search query</p>
                <a href="{{ route('merchant.inventory.products.index') }}" 
                   class="inline-flex items-center px-6 py-3 bg-slate-900 text-white font-semibold rounded-xl hover:bg-slate-800 transition">
                    Clear Search
                </a>
            @else
                <h3 class="text-xl font-semibold text-slate-600 mb-2">No products yet</h3>
                <p class="text-slate-500 mb-6">Start building your inventory by adding your first product</p>
                <a href="{{ route('merchant.inventory.products.create') }}" 
                   class="inline-flex items-center px-6 py-3 bg-slate-900 text-white font-semibold rounded-xl hover:bg-slate-800 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Create First Product
                </a>
            @endif
        </div>
    @endif

</div>
@endsection
