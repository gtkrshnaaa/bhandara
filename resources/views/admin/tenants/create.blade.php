@extends('layouts.admin')

@section('title', 'Create Tenant')

@section('content')
<div class="p-6 lg:p-8">
    
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('admin.tenants.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-brand-600 transition mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 mr-2">
                <path fill-rule="evenodd" d="M17 10a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 9.25H16.25A.75.75 0 0117 10z" clip-rule="evenodd" />
            </svg>
            Back to Tenants
        </a>
        <h1 class="text-3xl font-bold text-slate-900">Create New Tenant</h1>
        <p class="text-slate-500 mt-1">Add a new shop to the platform</p>
    </div>

    <!-- Form Card -->
    <div class="max-w-3xl bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
        <form method="POST" action="{{ route('admin.tenants.store') }}">
            @csrf

            <!-- Tenant Name -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">
                    Shop Name <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}"
                    required
                    class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition"
                    placeholder="e.g., Nexus Gear"
                >
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Slug -->
            <div class="mb-6">
                <label for="slug" class="block text-sm font-semibold text-slate-700 mb-2">
                    Slug <span class="text-red-500">*</span>
                </label>
                <div class="flex items-center gap-2">
                    <span class="text-sm text-slate-500">/u/</span>
                    <input 
                        type="text" 
                        id="slug" 
                        name="slug" 
                        value="{{ old('slug') }}"
                        required
                        class="flex-1 px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition"
                        placeholder="nexus-gear"
                    >
                </div>
                <p class="mt-1 text-xs text-slate-500">URL-friendly identifier (lowercase, hyphens allowed)</p>
                @error('slug')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Owner -->
            <div class="mb-6">
                <label for="owner_id" class="block text-sm font-semibold text-slate-700 mb-2">
                    Owner <span class="text-red-500">*</span>
                </label>
                <select 
                    id="owner_id" 
                    name="owner_id"
                    required
                    class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition"
                >
                    <option value="">Select owner</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('owner_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
                @error('owner_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Primary Color -->
            <div class="mb-6">
                <label for="primary_color" class="block text-sm font-semibold text-slate-700 mb-2">
                    Primary Color
                </label>
                <div class="flex items-center gap-3">
                    <input 
                        type="color" 
                        id="primary_color" 
                        name="primary_color" 
                        value="{{ old('primary_color', '#6366f1') }}"
                        class="w-16 h-12 rounded-lg border-2 border-slate-200 cursor-pointer"
                    >
                    <input 
                        type="text" 
                        value="{{ old('primary_color', '#6366f1') }}"
                        class="flex-1 px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition"
                        readonly
                        id="color_hex"
                    >
                </div>
                <p class="mt-1 text-xs text-slate-500">Brand color for storefront theme</p>
                @error('primary_color')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Active Status -->
            <div class="mb-8">
                <label class="flex items-center cursor-pointer">
                    <input 
                        type="checkbox" 
                        name="is_active" 
                        value="1"
                        {{ old('is_active', true) ? 'checked' : '' }}
                        class="w-5 h-5 rounded border-slate-300 text-brand-600 focus:ring-brand-500"
                    >
                    <span class="ml-3 text-sm font-medium text-slate-700">
                        Active (tenant can access storefront)
                    </span>
                </label>
            </div>

            <!-- Actions -->
            <div class="flex gap-4">
                <button 
                    type="submit"
                    class="flex-1 bg-brand-600 text-white font-bold py-3.5 px-6 rounded-xl hover:bg-brand-700 transition shadow-lg"
                >
                    Create Tenant
                </button>
                <a 
                    href="{{ route('admin.tenants.index') }}"
                    class="px-6 py-3.5 bg-slate-100 text-slate-700 font-semibold rounded-xl hover:bg-slate-200 transition text-center"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>

</div>

<script>
    // Sync color picker with hex input
    const colorPicker = document.getElementById('primary_color');
    const colorHex = document.getElementById('color_hex');
    
    colorPicker.addEventListener('input', (e) => {
        colorHex.value = e.target.value;
    });
</script>

@endsection
