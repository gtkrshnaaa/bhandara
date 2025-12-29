@extends('layouts.admin')

@section('title', 'Super Admin Dashboard')

@section('content')
<div class="p-6 lg:p-8">
    
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Super Admin Dashboard</h1>
        <p class="text-slate-500 mt-1">System-wide orchestration and control</p>
    </div>

    @php
        $stats = [
            'tenants' => \App\Models\Tenant::count(),
        $totalTenants = \App\Models\Tenant::count();
        $totalUsers = \App\Models\User::count();
        $totalProducts = \App\Models\Product::count();
        $totalOrders = \App\Models\Order::count();
    @endphp

    <!-- Overview Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Tenants -->
        <a href="{{ route('admin.tenants.index') }}" class="bg-white rounded-xl border border-slate-200 p-6 hover:shadow-lg transition group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:bg-indigo-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72m-13.5 8.65h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .415.336.75.75.75Z" />
                    </svg>
                </div>
            </div>
            <h3 class="text-3xl font-bold text-slate-900 mb-2">{{ $totalTenants }}</h3>
            <p class="text-sm text-slate-500">Total Tenants</p>
        </a>

        <!-- Users -->
        <a href="{{ route('admin.users.index') }}" class="bg-white rounded-xl border border-slate-200 p-6 hover:shadow-lg transition group">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:bg-blue-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                </div>
            </div>
            <h3 class="text-3xl font-bold text-slate-900 mb-2">{{ $totalUsers }}</h3>
            <p class="text-sm text-slate-500">Total Users</p>
        </a>

        <!-- Products -->
        <div class="bg-white rounded-xl border border-slate-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                    </svg>
                </div>
            </div>
            <h3 class="text-3xl font-bold text-slate-900 mb-2">{{ $totalProducts }}</h3>
            <p class="text-sm text-slate-500">Total Products</p>
        </div>

        <!-- Orders -->
        <div class="bg-white rounded-xl border border-slate-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-yellow-50 text-yellow-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>
                </div>
            </div>
            <h3 class="text-3xl font-bold text-slate-900 mb-2">{{ $totalOrders }}</h3>
            <p class="text-sm text-slate-500">Total Orders</p>
        </div>
    </div>

    <!-- Welcome Message -->
    <div class="bg-gradient-to-r from-slate-900 to-slate-700 rounded-2xl p-8 mb-8 text-white">
        <h2 class="text-2xl font-bold mb-2">Welcome, {{ Auth::user()->name }}! 👋</h2>
        <p class="text-slate-300 mb-4">System overview and recent activity across all tenants.</p>
        <div class="flex gap-4">
            <a href="{{ route('admin.tenants.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-white/20 hover:bg-white/30 rounded-lg font-semibold transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Create New Tenant
            </a>
        </div>
    </div>

    <!-- Recent Activity Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Tenants -->
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-900">Recent Tenants</h3>
                    <a href="{{ route('admin.tenants.index') }}" class="text-sm font-semibold text-brand-600 hover:text-brand-700">
                        View All →
                    </a>
                </div>
            </div>
            <div class="divide-y divide-slate-100">
                @foreach(\App\Models\Tenant::with('owner')->latest()->take(5)->get() as $tenant)
                    <div class="p-4 hover:bg-slate-50 transition">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-semibold text-slate-900">{{ $tenant->name }}</span>
                            @if($tenant->is_active)
                                <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-700 font-semibold">Active</span>
                            @else
                                <span class="text-xs px-2 py-1 rounded-full bg-red-100 text-red-700 font-semibold">Inactive</span>
                            @endif
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <code class="text-xs text-slate-500 bg-slate-100 px-2 py-1 rounded">{{ $tenant->slug }}</code>
                            <span class="text-slate-500">{{ $tenant->owner->name }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Users -->
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-slate-900">Recent Users</h3>
                    <a href="{{ route('admin.users.index') }}" class="text-sm font-semibold text-brand-600 hover:text-brand-700">
                        View All →
                    </a>
                </div>
            </div>
            <div class="divide-y divide-slate-100">
                @foreach(\App\Models\User::withCount('tenants')->latest()->take(5)->get() as $user)
                    <div class="p-4 hover:bg-slate-50 transition">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-brand-500 to-purple-600 flex items-center justify-center text-white text-sm font-bold">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div>
                                    <span class="font-semibold text-slate-900 block">{{ $user->name }}</span>
                                    <span class="text-xs text-slate-500">{{ $user->email }}</span>
                                </div>
                            </div>
                            @if($user->email === 'admin@bhandara.id')
                                <span class="text-xs px-2 py-1 rounded-full bg-purple-100 text-purple-700 font-semibold ">Admin</span>
                            @else
                                <span class="text-xs text-slate-500">{{ $user->tenants_count }} shops</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection
