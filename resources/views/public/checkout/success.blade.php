@extends('layouts.public')

@section('title', 'Order Confirmed')

@section('content')

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    
    <!-- Success Icon -->
    <div class="text-center mb-8">
        <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-green-100 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10 text-green-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-slate-900 mb-2">Order Placed Successfully!</h1>
        <p class="text-slate-500">Thank you for your order. We'll process it shortly.</p>
    </div>

    <!-- Order Details Card -->
    <div class="bg-white rounded-2xl border border-slate-200 p-8 mb-6">
        <div class="grid grid-cols-2 gap-6 mb-6 pb-6 border-b border-slate-200">
            <div>
                <p class="text-sm text-slate-500 mb-1">Order Number</p>
                <p class="font-bold text-slate-900">{{ $order->order_number }}</p>
            </div>
            <div>
                <p class="text-sm text-slate-500 mb-1">Order Status</p>
                <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="font-semibold text-slate-900 mb-3">Customer Information</h3>
            <dl class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <dt class="text-slate-500">Name:</dt>
                    <dd class="font-medium text-slate-900">{{ $order->customer->name }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-slate-500">Phone:</dt>
                    <dd class="font-medium text-slate-900">{{ $order->customer->phone }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-slate-500">Address:</dt>
                    <dd class="font-medium text-slate-900 text-right max-w-xs">{{ $order->customer->address }}</dd>
                </div>
            </dl>
        </div>

        <div class="pt-6 border-t border-slate-200">
            <div class="flex justify-between items-center">
                <span class="text-lg font-semibold text-slate-900">Total Amount</span>
                <span class="text-2xl font-bold text-brand-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <!-- Next Steps -->
    <div class="bg-blue-50 rounded-xl p-6 mb-6">
        <h3 class="font-semibold text-blue-900 mb-3">What's Next?</h3>
        <ol class="space-y-2 text-sm text-blue-800">
            <li class="flex gap-2">
                <span class="font-bold">1.</span>
                <span>We'll review your order and confirm availability</span>
            </li>
            <li class="flex gap-2">
                <span class="font-bold">2.</span>
                <span>You'll receive order confirmation from the merchant</span>
            </li>
            <li class="flex gap-2">
                <span class="font-bold">3.</span>
                <span>Make payment via bank transfer as instructed</span>
            </li>
            <li class="flex gap-2">
                <span class="font-bold">4.</span>
                <span>Your order will be shipped once payment is verified</span>
            </li>
        </ol>
    </div>

    <!-- Actions -->
    <div class="flex gap-4">
        <a href="{{ route('storefront.index', $tenant->slug) }}" 
           class="flex-1 bg-brand-600 text-white text-center font-bold py-3 rounded-xl hover:bg-brand-700 transition">
            Continue Shopping
        </a>
    </div>

</div>

@endsection
