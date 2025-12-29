@extends('layouts.public')

@section('title', 'Shopping Cart')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <!-- Header -->
    <h1 class="text-3xl font-bold text-slate-900 mb-8">Shopping Cart</h1>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    @if(count($cartItems) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Cart Items -->
            <div class="lg:col-span-2 space-y-4">
                @foreach($cartItems as $item)
                    <div class="bg-white rounded-xl border border-slate-200 p-6">
                        <div class="flex gap-4">
                            <!-- Product Image Placeholder -->
                            <div class="w-24 h-24 rounded-lg bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-12 h-12 text-slate-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                                </svg>
                            </div>

                            <!-- Product Info -->
                            <div class="flex-1">
                                <h3 class="font-bold text-slate-900 mb-1">{{ $item['product']->name }}</h3>
                                <p class="text-lg font-semibold text-brand-600">Rp {{ number_format($item['product']->price, 0, ',', '.') }}</p>
                                
                                <!-- Quantity Controls -->
                                <form method="POST" action="{{ route('storefront.cart.update', $tenant->slug) }}" class="mt-4">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item['product']->id }}">
                                    <div class="flex items-center gap-3">
                                        <label class="text-sm font-medium text-slate-700">Qty:</label>
                                        <input 
                                            type="number" 
                                            name="quantity" 
                                            value="{{ $item['quantity'] }}" 
                                            min="1" 
                                            max="{{ $item['product']->stock }}"
                                            class="w-20 px-3 py-2 rounded-lg border border-slate-200"
                                            onchange="this.form.submit()"
                                        >
                                        <span class="text-sm text-slate-500">(Max: {{ $item['product']->stock }})</span>
                                    </div>
                                </form>
                            </div>

                            <!-- Remove Button -->
                            <div>
                                <form method="POST" action="{{ route('storefront.cart.remove', [$tenant->slug, $item['product']->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Subtotal -->
                        <div class="mt-4 pt-4 border-t border-slate-200 flex justify-between items-center">
                            <span class="text-sm text-slate-600">Subtotal:</span>
                            <span class="font-bold text-slate-900">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl border border-slate-200 p-6 sticky top-4">
                    <h2 class="text-xl font-bold text-slate-900 mb-6">Order Summary</h2>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-slate-600">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-slate-600">
                            <span>Shipping</span>
                            <span class="text-sm">Calculated at checkout</span>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-200 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold text-slate-900">Total</span>
                            <span class="text-2xl font-bold text-brand-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <a href="{{ route('storefront.checkout.index', $tenant->slug) }}" 
                       class="block w-full bg-brand-600 text-white text-center font-bold py-3.5 rounded-xl hover:bg-brand-700 transition mb-3">
                        Proceed to Checkout
                    </a>

                    <a href="{{ route('storefront.index', $tenant->slug) }}" 
                       class="block w-full text-center text-slate-600 hover:text-brand-600 font-semibold py-2">
                        Continue Shopping
                    </a>
                </div>
            </div>

        </div>
    @else
        <!-- Empty Cart -->
        <div class="text-center py-16">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-24 h-24 mx-auto text-slate-300 mb-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
            </svg>
            <h3 class="text-2xl font-bold text-slate-600 mb-2">Your cart is empty</h3>
            <p class="text-slate-500 mb-6">Start adding products to your cart!</p>
            <a href="{{ route('storefront.index', $tenant->slug) }}" 
               class="inline-block px-6 py-3 bg-brand-600 text-white font-semibold rounded-xl hover:bg-brand-700 transition">
                Browse Products
            </a>
        </div>
    @endif

</div>

@endsection
