@extends('layouts.merchant')

@section('title', 'Customers')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Customers</h1>
        <p class="text-slate-500 mt-1">Manage your customer database</p>
    </div>

    <!-- Customers Table -->
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
        @if($customers->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Customer</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Contact</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Orders</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Joined</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach($customers as $customer)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-brand-500 to-purple-600 flex items-center justify-center text-white font-bold">
                                            {{ substr($customer->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-semibold text-slate-900">{{ $customer->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-slate-600">{{ $customer->phone }}</div>
                                    <div class="text-xs text-slate-400 mt-0.5">{{ Str::limit($customer->address, 30) }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-brand-100 text-brand-700">
                                        {{ $customer->orders_count }} {{ Str::plural('order', $customer->orders_count) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500">
                                    {{ $customer->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('merchant.customers.show', $customer) }}" 
                                       class="inline-flex items-center px-3 py-2 bg-slate-900 text-white text-sm font-semibold rounded-lg hover:bg-slate-800 transition">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($customers->hasPages())
                <div class="px-6 py-4 border-t border-slate-200">
                    {{ $customers->links() }}
                </div>
            @endif
        @else
            <div class="p-12 text-center text-slate-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-16 h-16 mx-auto text-slate-300 mb-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                <p>No customers yet</p>
            </div>
        @endif
    </div>

</div>
@endsection
