@extends('layouts.merchant')

@section('title', 'Order Details')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Back Button -->
    <a href="{{ route('merchant.orders.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-brand-600 transition mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 mr-2">
            <path fill-rule="evenodd" d="M17 10a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 9.25H16.25A.75.75 0 0117 10z" clip-rule="evenodd" />
        </svg>
        Back to Orders
    </a>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    <!-- Order Header -->
    <div class="bg-white rounded-2xl border border-slate-200 p-8 mb-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Order {{ $order->order_number }}</h1>
                <p class="text-slate-500">Placed on {{ $order->created_at->format('d M Y, H:i') }}</p>
            </div>
            
            @php
                $statusColors = [
                    'pending' => 'bg-yellow-100 text-yellow-800',
                    'paid' => 'bg-blue-100 text-blue-800',
                    'processing' => 'bg-purple-100 text-purple-800',
                    'shipped' => 'bg-indigo-100 text-indigo-800',
                    'completed' => 'bg-green-100 text-green-800',
                    'cancelled' => 'bg-red-100 text-red-800',
                ];
            @endphp
            <span class="inline-block px-4 py-2 text-sm font-bold rounded-full {{ $statusColors[$order->status] ?? 'bg-slate-100 text-slate-800' }}">
                {{ ucfirst($order->status) }}
            </span>
        </div>

        <!-- Customer Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6 border-t border-slate-200">
            <div>
                <h3 class="font-semibold text-slate-900 mb-3">Customer Information</h3>
                <dl class="space-y-2 text-sm">
                    <div>
                        <dt class="text-slate-500">Name:</dt>
                        <dd class="font-medium text-slate-900">{{ $order->customer->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-slate-500">Phone:</dt>
                        <dd class="font-medium text-slate-900">{{ $order->customer->phone }}</dd>
                    </div>
                    <div>
                        <dt class="text-slate-500">Address:</dt>
                        <dd class="font-medium text-slate-900">{{ $order->customer->address }}</dd>
                    </div>
                </dl>
            </div>

            @if($order->payment_proof)
                <div>
                    <h3 class="font-semibold text-slate-900 mb-3">Payment Proof</h3>
                    <p class="text-sm text-slate-600 break-all">{{ $order->payment_proof }}</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Order Items -->
    <div class="bg-white rounded-2xl border border-slate-200 p-8 mb-6">
        <h2 class="text-xl font-bold text-slate-900 mb-6">Order Items</h2>
        
        <div class="space-y-4">
            @foreach($items as $item)
                <div class="flex justify-between items-center py-3 border-b border-slate-100 last:border-0">
                    <div class="flex-1">
                        <p class="font-semibold text-slate-900">{{ $item['product_name'] }}</p>
                        <p class="text-sm text-slate-500">{{ $item['quantity'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                    </div>
                    <p class="font-bold text-slate-900">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                </div>
            @endforeach
        </div>

        <div class="pt-4 mt-4 border-t border-slate-200">
            <div class="flex justify-between items-center">
                <span class="text-lg font-semibold text-slate-900">Total</span>
                <span class="text-2xl font-bold text-brand-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <!-- Update Status -->
    <div class="bg-white rounded-2xl border border-slate-200 p-8">
        <h2 class="text-xl font-bold text-slate-900 mb-6">Update Order Status</h2>
        
        <form method="POST" action="{{ route('merchant.orders.update-status', $order) }}" class="flex gap-4">
            @csrf
            <select name="status" class="flex-1 px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <button type="submit" class="px-6 py-3 bg-slate-900 text-white font-semibold rounded-xl hover:bg-slate-800 transition">
                Update Status
            </button>
        </form>
    </div>

</div>
@endsection
