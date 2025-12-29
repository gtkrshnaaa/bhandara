@extends('layouts.merchant')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Dashboard</h1>
        <p class="text-slate-500 mt-1">Welcome back, {{ Auth::user()->name }}</p>
    </div>

    @php
        $tenant = Auth::user()->tenants()->first();
        $stats = [
            'products' => $tenant ? $tenant->products()->count() : 0,
            'total_products' => $tenant ? $tenant->products()->count() : 0,
            'total_orders' => $tenant ? $tenant->orders()->count() : 0,
            'total_customers' => $tenant ? $tenant->customers()->count() : 0,
            'total_revenue' => $tenant ? $tenant->orders()->sum('total_price') : 0,
        ];
    @endphp

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Products -->
        <a href="{{ route('merchant.inventory.products.index') }}" class="bg-white rounded-xl border border-slate-200 p-6 hover:shadow-lg transition group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:bg-indigo-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                    </svg>
                </div>
            </div>
            <h3 class="text-3xl font-bold text-slate-900 mb-2">{{ $stats['total_products'] }}</h3>
            <p class="text-sm text-slate-500">Total Products</p>
        </a>

        <!-- Orders -->
        <a href="{{ route('merchant.orders.index') }}" class="bg-white rounded-xl border border-slate-200 p-6 hover:shadow-lg transition group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:bg-blue-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>
                </div>
            </div>
            <h3 class="text-3xl font-bold text-slate-900 mb-2">{{ $stats['total_orders'] }}</h3>
            <p class="text-sm text-slate-500">Total Orders</p>
        </a>

        <!-- Customers -->
        <div class="bg-white rounded-xl border border-slate-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                </div>
            </div>
            <h3 class="text-3xl font-bold text-slate-900 mb-2">{{ $stats['total_customers'] }}</h3>
            <p class="text-sm text-slate-500">Total Customers</p>
        </div>

        <!-- Revenue -->
        <div class="bg-white rounded-xl border border-slate-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-yellow-50 text-yellow-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
            </div>
            <h3 class="text-3xl font-bold text-slate-900 mb-2">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h3>
            <p class="text-sm text-slate-500">Total Revenue</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('merchant.inventory.products.index') }}" class="group bg-white rounded-2xl border border-slate-200 p-6 hover:shadow-xl transition">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                    </svg>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-slate-400 group-hover:text-indigo-600 transition">
                    <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-indigo-600 transition">Manage Products</h3>
            <p class="text-sm text-slate-500">View and edit your inventory catalog</p>
        </a>

        <a href="{{ route('merchant.orders.index') }}" class="group bg-white rounded-2xl border border-slate-200 p-6 hover:shadow-xl transition">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-slate-400 group-hover:text-blue-600 transition">
                    <path fill-rule="evenodd" d="M3 10a.75.75 0 01.75-.75h10.638L10.23 5.29a.75.75 0 111.04-1.08l5.5 5.25a.75.75 0 010 1.08l-5.5 5.25a.75.75 0 11-1.04-1.08l4.158-3.96H3.75A.75.75 0 013 10z" clip-rule="evenodd" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-blue-600 transition">Manage Orders</h3>
            <p class="text-sm text-slate-500">View and update customer orders</p>
        </a>

        @if($tenant)
            <a href="{{ route('storefront.index', $tenant->slug) }}" target="_blank" class="group bg-white rounded-2xl border border-slate-200 p-6 hover:shadow-xl transition">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-14 h-14 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72m-13.5 8.65h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .415.336.75.75.75Z" />
                        </svg>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-slate-400 group-hover:text-emerald-600 transition">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-emerald-600 transition">View Storefront</h3>
                <p class="text-sm text-slate-500">See your shop as customers do</p>
            </a>
        @endif
    </div>

    <!-- Welcome Message -->
    @if($tenant)
        <div class="bg-gradient-to-r from-brand-500 to-purple-600 rounded-2xl p-8 mb-8 text-white">
            <h2 class="text-2xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h2>
            <p class="text-brand-50 mb-4">Here's what's happening with {{ $tenant->name }} today.</p>
            <div class="flex gap-4">
                <a href="{{ route('storefront.index', $tenant->slug) }}" target="_blank" 
                   class="inline-flex items-center px-4 py-2 bg-white/20 hover:bg-white/30 rounded-lg font-semibold transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                    View Storefront
                </a>
            </div>
        </div>
    @endif

    <!-- Recent Activity Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Orders -->
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-900">Recent Orders</h3>
                    <a href="{{ route('merchant.orders.index') }}" class="text-sm font-semibold text-brand-600 hover:text-brand-700">
                        View All →
                    </a>
                </div>
            </div>
            <div class="divide-y divide-slate-100">
                @php
                    $recentOrders = $tenant ? $tenant->orders()->latest()->take(5)->get() : collect();
                @endphp
                @forelse($recentOrders as $order)
                    <div class="p-4 hover:bg-slate-50 transition">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-mono text-sm font-semibold text-slate-900">{{ $order->order_number }}</span>
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
                            <span class="text-xs px-2 py-1 rounded-full font-semibold {{ $statusColors[$order->status] ?? 'bg-slate-100 text-slate-800' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-500">{{ $order->customer->name }}</span>
                            <span class="font-semibold text-slate-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-12 h-12 mx-auto text-slate-300 mb-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                        </svg>
                        <p class="text-sm">No orders yet</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Products -->
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-900">Recent Products</h3>
                    <a href="{{ route('merchant.inventory.products.index') }}" class="text-sm font-semibold text-brand-600 hover:text-brand-700">
                        View All →
                    </a>
                </div>
            </div>
            <div class="divide-y divide-slate-100">
                @php
                    $recentProducts = $tenant ? $tenant->products()->latest()->take(5)->get() : collect();
                @endphp
                @forelse($recentProducts as $product)
                    <div class="p-4 hover:bg-slate-50 transition">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-semibold text-slate-900">{{ Str::limit($product->name, 30) }}</span>
                            <span class="text-xs px-2 py-1 rounded-full {{ $product->is_visible ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-600' }}">
                                {{ $product->is_visible ? 'Visible' : 'Hidden' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-500">Stock: {{ $product->stock }}</span>
                            <span class="font-semibold text-brand-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-12 h-12 mx-auto text-slate-300 mb-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                        </svg>
                        <p class="text-sm">No products yet</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</div>
@endsection
