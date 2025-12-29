@extends('layouts.public')

@section('title', 'Checkout')

@section('content')

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <h1 class="text-3xl font-bold text-slate-900 mb-8">Checkout</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Checkout Form -->
        <div class="lg:col-span-2">
            <form method="POST" action="{{ route('storefront.checkout.store', $tenant->slug) }}" class="bg-white rounded-xl border border-slate-200 p-8">
                @csrf

                <h2 class="text-xl font-bold text-slate-900 mb-6">Customer Information</h2>

                <!-- Name -->
                <div class="mb-6">
                    <label for="customer_name" class="block text-sm font-semibold text-slate-700 mb-2">
                        Full Name <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="customer_name" 
                        name="customer_name" 
                        value="{{ old('customer_name') }}"
                        required
                        class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition"
                        placeholder="John Doe"
                    >
                    @error('customer_name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="mb-6">
                    <label for="customer_phone" class="block text-sm font-semibold text-slate-700 mb-2">
                        Phone Number <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="tel" 
                        id="customer_phone" 
                        name="customer_phone" 
                        value="{{ old('customer_phone') }}"
                        required
                        class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition"
                        placeholder="08123456789"
                    >
                    @error('customer_phone')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address -->
                <div class="mb-6">
                    <label for="customer_address" class="block text-sm font-semibold text-slate-700 mb-2">
                        Shipping Address <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="customer_address" 
                        name="customer_address" 
                        rows="3"
                        required
                        class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition"
                        placeholder="Street address, city, postal code"
                    >{{ old('customer_address') }}</textarea>
                    @error('customer_address')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <h2 class="text-xl font-bold text-slate-900 mb-4 mt-8">Payment Information</h2>
                
                <div class="mb-6 p-4 bg-blue-50 rounded-xl">
                    <p class="text-sm text-blue-900 font-semibold mb-2">Payment Method: Bank Transfer</p>
                    <p class="text-xs text-blue-700">Please transfer to merchant's bank account after placing order.</p>
                </div>

                <!-- Payment Proof (Optional) -->
                <div class="mb-6">
                    <label for="payment_proof" class="block text-sm font-semibold text-slate-700 mb-2">
                        Payment Proof (Optional)
                    </label>
                    <input 
                        type="text" 
                        id="payment_proof" 
                        name="payment_proof" 
                        value="{{ old('payment_proof') }}"
                        class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition"
                        placeholder="Upload receipt and paste URL here"
                    >
                    <p class="mt-1 text-xs text-slate-500">You can add payment proof now or submit later</p>
                    @error('payment_proof')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button 
                    type="submit"
                    class="w-full bg-brand-600 text-white font-bold py-4 rounded-xl hover:bg-brand-700 transition shadow-lg"
                >
                    Place Order
                </button>
            </form>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl border border-slate-200 p-6 sticky top-4">
                <h2 class="text-xl font-bold text-slate-900 mb-6">Order Summary</h2>
                
                <div class="space-y-4 mb-6">
                    @foreach($cartItems as $item)
                        <div class="flex justify-between text-sm">
                            <div class="flex-1">
                                <p class="font-medium text-slate-900">{{ $item['product']->name }}</p>
                                <p class="text-slate-500">{{ $item['quantity'] }} x Rp {{ number_format($item['product']->price, 0, ',', '.') }}</p>
                            </div>
                            <p class="font-semibold text-slate-900">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="pt-4 border-t border-slate-200">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-semibold text-slate-900">Total</span>
                        <span class="text-2xl font-bold text-brand-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
