@extends('layouts.merchant')

@section('title', 'Merchant Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Merchant Dashboard</h1>
        <p class="mt-2 text-slate-600">Manage your store with elegance</p>
    </div>
    
    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <p class="text-sm font-medium text-slate-600">My Products</p>
            <p class="text-3xl font-bold text-slate-900 mt-2">0</p>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <p class="text-sm font-medium text-slate-600">Pending Orders</p>
            <p class="text-3xl font-bold text-slate-900 mt-2">0</p>
        </div>
    </div>
    
    <!-- Content -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8">
        <div class="text-center py-12">
            <h3 class="text-lg font-medium text-slate-900">Your Bhandara Treasury</h3>
            <p class="mt-2 text-sm text-slate-600">Start managing your inventory and orders from here</p>
        </div>
    </div>
</div>
@endsection
