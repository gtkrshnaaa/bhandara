@extends('layouts.merchant')

@section('title', 'Create Product')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('merchant.inventory.products.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-indigo-600 transition mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 mr-2">
                <path fill-rule="evenodd" d="M17 10a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 9.25H16.25A.75.75 0 0117 10z" clip-rule="evenodd" />
            </svg>
            Back to Products
        </a>
        <h1 class="text-3xl font-bold text-slate-900">Create New Product</h1>
        <p class="text-slate-500 mt-1">Add a new item to your inventory</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
        <form method="POST" action="{{ route('merchant.inventory.products.store') }}">
            @csrf

            <!-- Product Name -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">
                    Product Name <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}"
                    required
                    class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition"
                    placeholder="e.g., Wireless Mouse"
                >
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category & SKU -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="category_id" class="block text-sm font-semibold text-slate-700 mb-2">
                        Category
                    </label>
                    <select 
                        id="category_id" 
                        name="category_id"
                        class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition"
                    >
                        <option value="">Select category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="sku" class="block text-sm font-semibold text-slate-700 mb-2">
                        SKU
                    </label>
                    <input 
                        type="text" 
                        id="sku" 
                        name="sku" 
                        value="{{ old('sku') }}"
                        class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition"
                        placeholder="e.g., WM-001"
                    >
                    @error('sku')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">
                    Description
                </label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="4"
                    class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition resize-none"
                    placeholder="Describe your product..."
                >{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Price & Stock -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="price" class="block text-sm font-semibold text-slate-700 mb-2">
                        Price (Rp) <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="number" 
                        id="price" 
                        name="price" 
                        value="{{ old('price') }}"
                        required
                        min="0"
                        step="0.01"
                        class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition"
                        placeholder="250000"
                    >
                    @error('price')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="stock" class="block text-sm font-semibold text-slate-700 mb-2">
                        Stock Quantity <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="number" 
                        id="stock" 
                        name="stock" 
                        value="{{ old('stock', 0) }}"
                        required
                        min="0"
                        class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition"
                        placeholder="50"
                    >
                    @error('stock')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Visibility Options -->
            <div class="mb-8 space-y-3">
                <label class="flex items-center cursor-pointer">
                    <input 
                        type="checkbox" 
                        name="is_visible" 
                        value="1"
                        {{ old('is_visible', true) ? 'checked' : '' }}
                        class="w-5 h-5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                    >
                    <span class="ml-3 text-sm font-medium text-slate-700">
                        Visible in storefront
                    </span>
                </label>

                <label class="flex items-center cursor-pointer">
                    <input 
                        type="checkbox" 
                        name="is_featured" 
                        value="1"
                        {{ old('is_featured') ? 'checked' : '' }}
                        class="w-5 h-5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                    >
                    <span class="ml-3 text-sm font-medium text-slate-700">
                        Mark as featured
                    </span>
                </label>
            </div>

            <!-- Actions -->
            <div class="flex gap-4">
                <button 
                    type="submit"
                    class="flex-1 bg-slate-900 text-white font-bold py-3.5 px-6 rounded-xl hover:bg-slate-800 transition shadow-lg"
                >
                    Create Product
                </button>
                <a 
                    href="{{ route('merchant.inventory.products.index') }}"
                    class="px-6 py-3.5 bg-slate-100 text-slate-700 font-semibold rounded-xl hover:bg-slate-200 transition text-center"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
