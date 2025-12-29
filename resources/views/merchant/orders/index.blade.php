@extends('layouts.merchant')

@section('title', 'Orders')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Orders</h1>
        <p class="text-slate-500 mt-1">Manage customer orders</p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    <!-- Orders Table -->
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
        @if($orders->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Order #</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Customer</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Total</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Date</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach($orders as $order)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4">
                                    <span class="font-mono text-sm font-semibold text-slate-900">{{ $order->order_number }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        <div class="font-medium text-slate-900">{{ $order->customer->name }}</div>
                                        <div class="text-sm text-slate-500">{{ $order->customer->phone }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-semibold text-slate-900">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
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
                                    <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full {{ $statusColors[$order->status] ?? 'bg-slate-100 text-slate-800' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500">
                                    {{ $order->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('merchant.orders.show', $order) }}" 
                                       class="inline-flex items-center px-3 py-2 bg-slate-900 text-white text-sm font-semibold rounded-lg hover:bg-slate-800 transition">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($orders->hasPages())
                <div class="px-6 py-4 border-t border-slate-200">
                    {{ $orders->links() }}
                </div>
            @endif
        @else
            <div class="p-12 text-center text-slate-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-16 h-16 mx-auto text-slate-300 mb-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                </svg>
                <p>No orders yet</p>
            </div>
        @endif
    </div>

</div>
@endsection
