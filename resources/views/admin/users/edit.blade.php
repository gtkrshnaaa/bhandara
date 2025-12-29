@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="p-6 lg:p-8">
    
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-300 hover:text-white transition mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 mr-2">
                <path fill-rule="evenodd" d="M17 10a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 9.25H16.25A.75.75 0 0117 10z" clip-rule="evenodd" />
            </svg>
            Back to Users
        </a>
        <h1 class="text-3xl font-bold text-slate-900">Edit User</h1>
        <p class="text-slate-500 mt-1">Update user information</p>
    </div>

    <!-- Form Card -->
    <div class="max-w-2xl bg-white rounded-2xl border border-slate-200 shadow-sm p-8">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">
                    Name <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $user->name) }}"
                    required
                    class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition"
                >
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                    Email <span class="text-red-500">*</span>
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email', $user->email) }}"
                    required
                    class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition"
                >
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 p-4 bg-slate-50 rounded-xl">
                <p class="text-sm text-slate-600 mb-2 font-semibold">Change Password</p>
                <p class="text-xs text-slate-500">Leave blank to keep current password</p>
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                    New Password
                </label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition"
                    placeholder="Minimum 8 characters"
                >
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Confirmation -->
            <div class="mb-8">
                <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-2">
                    Confirm New Password
                </label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition"
                >
            </div>

            <!-- Actions -->
            <div class="flex gap-4">
                <button 
                    type="submit"
                    class="flex-1 bg-brand-600 text-white font-bold py-3.5 px-6 rounded-xl hover:bg-brand-700 transition shadow-lg"
                >
                    Update User
                </button>
                <a 
                    href="{{ route('admin.users.index') }}"
                    class="px-6 py-3.5 bg-slate-100 text-slate-700 font-semibold rounded-xl hover:bg-slate-200 transition text-center"
                >
                    Cancel
                </a>
            </div>
        </form>

        @if($user->email !== 'admin@bhandara.id')
            <!-- Delete Section -->
            <div class="mt-8 pt-8 border-t border-slate-200">
                <h3 class="font-semibold text-slate-900 mb-2">Danger Zone</h3>
                <p class="text-sm text-slate-600 mb-4">Deleting this user will remove all associated data. This action cannot be undone.</p>
                
                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Are you sure you want to delete this user?')">
                    @csrf
                    @method('DELETE')
                    <button 
                        type="submit"
                        class="px-6 py-2.5 bg-red-50 text-red-600 font-semibold rounded-xl hover:bg-red-100 transition"
                    >
                        Delete User
                    </button>
                </form>
            </div>
        @endif
    </div>

</div>
@endsection
