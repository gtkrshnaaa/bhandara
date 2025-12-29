@extends('layouts.merchant')

@section('title', 'Customer Details')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Back Button -->
    <a href="{{ route('merchant.customers.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-brand-600 transition mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 mr-2">
            <path fill-rule="evenodd" d="M17 10a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 9.25H16.25A.75.75 0 0117 10z" clip-rule="evenodd" />
        </svg>
        Back to Customers
    </a>

    <!-- Customer Info Card -->
    <div class="bg-white rounded-2xl border border-slate-200 p-8 mb-6">
        <div class="flex items-start gap-6 mb-6">
            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-brand-500 to-purple-600 flex items-center justify-center text-white text-3xl font-bold flex-shrink-0">
                {{ substr($customer->name, 0, 1) }}
            </div>
            <div class="flex-1">
                <h1 class="text-2xl font-bold text-slate-900 mb-2">{{ $customer->name }}</h1>
                <div class="space-y-1 text-sm text-slate-600">
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                        {{ $customer->phone }}
                    </div>
                    <div class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mt-0.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        {{ $customer->address }}
                    </div>
                </div>
            </div>
            <div class="text-right">
                <div class="text-sm text-slate-500 mb-1">Customer since</div>
                <div class="font-semibold text-slate-900">{{ $customer->created_at->format('d M Y') }}</div>
            </div>
        </div>

        <div class="pt-6 border-t border-slate-200">
            <div class="grid grid-cols-3 gap-6">
                <div>
                    <div class="text-sm text-slate-500 mb-1">Total Orders</div>
                    <div class="text-2xl font-bold text-slate-900">{{ $customer->orders->count() }}</div>
                </div>
                <div>
                    <div class="text-sm text-slate-500 mb-1">Total Spent</div>
                    <div class="text-2xl font-bold text-brand-600">Rp {{ number_format($customer->orders->sum('total_price'), 0, ',', '.') }}</div>
                </div>
                <div>
                    <div class="text-sm text-slate-500 mb-1">Average Order</div>
                    <div class="text-2xl font-bold text-slate-900">
                        Rp {{ $customer->orders->count() > 0 ? number_format($customer->orders->avg('total_price'), 0, ',', '.') : 0 }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Order History -->
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-200">
            <h2 class="text-xl font-bold text-slate-900">Order History</h2>
        </div>

        @if($customer->orders->count() > 0)
            <div class="divide-y divide-slate-200">
                @foreach($customer->orders as $order)
                    <div class="p-6 hover:bg-slate-50 transition">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <span class="font-mono text-sm font-semibold text-slate-900">{{ $order->order_number }}</span>
                                <span class="text-sm text-slate-500 ml-4">{{ $order->created_at->format('d M Y, H:i') }}</span>
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
                            <div class="flex items-center gap-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusColors[$order->status] ?? 'bg-slate-100 text-slate-800' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                                <span class="font-bold text-slate-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                                <a href="{{ route('merchant.orders.show', $order) }}" 
                                   class="text-sm font-semibold text-brand-600 hover:text-brand-700">
                                    View →
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-8 text-center text-slate-500">
                <p>No orders from this customer yet</p>
            </div>
        @endif
    </div>

</div>
@endsection
