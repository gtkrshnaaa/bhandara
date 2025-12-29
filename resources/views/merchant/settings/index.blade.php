@extends('layouts.merchant')

@section('title', 'Settings')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Shop Settings</h1>
        <p class="text-slate-500 mt-1">Manage your shop profile and preferences</p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    <!-- Settings Form -->
    <div class="bg-white rounded-2xl border border-slate-200 p-8">
        <form method="POST" action="{{ route('merchant.settings.update') }}">
            @csrf
            @method('PUT')

            <!-- Shop Name -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">
                    Shop Name <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $tenant->name) }}"
                    required
                    class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition"
                    placeholder="My Awesome Shop"
                >
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Shop Slug (Read-only) -->
            <div class="mb-6">
                <label for="slug" class="block text-sm font-semibold text-slate-700 mb-2">
                    Shop URL
                </label>
                <div class="flex items-center gap-2">
                    <span class="text-sm text-slate-500">{{ config('app.url') }}/u/</span>
                    <input 
                        type="text" 
                        id="slug" 
                        value="{{ $tenant->slug }}"
                        disabled
                        class="flex-1 px-4 py-3 rounded-xl border-2 border-slate-200 bg-slate-50 text-slate-600"
                    >
                </div>
                <p class="mt-1 text-xs text-slate-500">URL slug cannot be changed after creation</p>
            </div>

            <!-- Primary Color -->
            <div class="mb-6">
                <label for="primary_color" class="block text-sm font-semibold text-slate-700 mb-2">
                    Brand Color
                </label>
                <div class="flex items-center gap-4">
                    <input 
                        type="color" 
                        id="primary_color" 
                        name="primary_color" 
                        value="{{ old('primary_color', $tenant->primary_color ?? '#6366f1') }}"
                        class="h-12 w-20 rounded-lg border-2 border-slate-200 cursor-pointer"
                    >
                    <div class="flex-1">
                        <input 
                            type="text" 
                            value="{{ old('primary_color', $tenant->primary_color ?? '#6366f1') }}"
                            class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition font-mono text-sm"
                            readonly
                            id="primary_color_text"
                        >
                    </div>
                </div>
                <p class="mt-1 text-xs text-slate-500">This color will be used in your public storefront</p>
                @error('primary_color')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Preview -->
            <div class="mb-8 p-6 rounded-xl border-2 border-slate-200 bg-slate-50">
                <div class="text-sm font-semibold text-slate-700 mb-3">Preview</div>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold" 
                         style="background-color: {{ $tenant->primary_color ?? '#6366f1' }}"
                         id="color_preview">
                        {{ substr($tenant->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="font-bold text-slate-900">{{ $tenant->name }}</div>
                        <div class="text-sm text-slate-500">{{ config('app.url') }}/u/{{ $tenant->slug }}</div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex gap-4">
                <button 
                    type="submit"
                    class="px-6 py-3 bg-brand-600 text-white font-bold rounded-xl hover:bg-brand-700 transition"
                >
                    Save Changes
                </button>
                <a href="{{ route('merchant.dashboard') }}" 
                   class="px-6 py-3 bg-slate-100 text-slate-700 font-semibold rounded-xl hover:bg-slate-200 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <!-- Storefront Link -->
    <div class="mt-6 bg-gradient-to-r from-brand-500 to-purple-600 rounded-2xl p-6 text-white">
        <h3 class="font-bold mb-2">View Your Storefront</h3>
        <p class="text-brand-50 text-sm mb-4">See how customers view your shop</p>
        <a href="{{ route('storefront.index', $tenant->slug) }}" target="_blank"
           class="inline-flex items-center px-4 py-2 bg-white/20 hover:bg-white/30 rounded-lg font-semibold transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
            </svg>
            Open Storefront
        </a>
    </div>

</div>

<script>
    // Update preview when color changes
    document.getElementById('primary_color').addEventListener('input', function(e) {
        const color = e.target.value;
        document.getElementById('primary_color_text').value = color;
        document.getElementById('color_preview').style.backgroundColor = color;
    });
</script>
@endsection
