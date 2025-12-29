@extends('layouts.admin')

@section('title', $tenant->name . ' - Tenant Details')

@section('content')
<div class="p-6 lg:p-8">
    
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('admin.tenants.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-300 hover:text-white transition mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 mr-2">
                <path fill-rule="evenodd" d="M17 10a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 9.25H16.25A.75.75 0 0117 10z" clip-rule="evenodd" />
            </svg>
            Back to Tenants
        </a>
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-brand-500 to-purple-600 flex items-center justify-center text-white font-bold text-2xl shadow-lg">
                    {{ substr($tenant->name, 0, 1) }}
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-slate-900">{{ $tenant->name }}</h1>
                    <p class="text-slate-500 mt-1">{{ $tenant->owner->name }} • Created {{ $tenant->created_at->diffForHumans() }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('storefront.index', $tenant->slug) }}" 
                   target="_blank"
                   class="px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                    View Storefront
                </a>
                <a href="{{ route('admin.tenants.edit', $tenant) }}" 
                   class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                    Edit Tenant
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl border border-slate-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-slate-900 mb-1">{{ $stats['products'] }}</h3>
            <p class="text-sm text-slate-500">Products</p>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-slate-900 mb-1">{{ $stats['orders'] }}</h3>
            <p class="text-sm text-slate-500">Orders</p>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-slate-900 mb-1">{{ $stats['customers'] }}</h3>
            <p class="text-sm text-slate-500">Customers</p>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 rounded-lg bg-yellow-50 text-yellow-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-slate-900 mb-1">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</h3>
            <p class="text-sm text-slate-500">Revenue</p>
        </div>
    </div>

    <!-- Tenant Info -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl border border-slate-200 p-6">
            <h3 class="font-semibold text-slate-900 mb-4">Tenant Information</h3>
            <dl class="space-y-3">
                <div>
                    <dt class="text-sm text-slate-500">Slug</dt>
                    <dd class="text-sm font-mono text-slate-900">/u/{{ $tenant->slug }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-slate-500">Owner</dt>
                    <dd class="text-sm text-slate-900">{{ $tenant->owner->name }}</dd>
                    <dd class="text-xs text-slate-500">{{ $tenant->owner->email }}</dd>
                </div>
                <div>
                    <dt class="text-sm text-slate-500">Primary Color</dt>
                    <dd class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded border border-slate-200" style="background-color: {{ $tenant->primary_color ?? '#6366f1' }}"></div>
                        <span class="text-sm font-mono text-slate-900">{{ $tenant->primary_color ?? '#6366f1' }}</span>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm text-slate-500">Status</dt>
                    <dd>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $tenant->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $tenant->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </dd>
                </div>
            </dl>
        </div>

        <div class="lg:col-span-2 bg-white rounded-xl border border-slate-200 p-6">
            <h3 class="font-semibold text-slate-900 mb-4">Recent Products</h3>
            <div class="space-y-3">
                @forelse($tenant->products()->latest()->take(5)->get() as $product)
                    <div class="flex items-center justify-between py-2">
                        <div>
                            <p class="font-medium text-slate-900">{{ $product->name }}</p>
                            <p class="text-sm text-slate-500">
                                Rp {{ number_format($product->price, 0, ',', '.') }} • Stock: {{ $product->stock }}
                            </p>
                        </div>
                        <span class="text-xs px-2 py-1 rounded-full {{ $product->is_visible ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-600' }}">
                            {{ $product->is_visible ? 'Visible' : 'Hidden' }}
                        </span>
                    </div>
                @empty
                    <p class="text-sm text-slate-500 text-center py-8">No products yet</p>
                @endforelse
            </div>
        </div>
    </div>

</div>
@endsection
