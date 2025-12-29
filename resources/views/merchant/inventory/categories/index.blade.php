@extends('layouts.merchant')

@section('title', 'Categories')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900">Categories</h1>
        <p class="text-slate-500 mt-1">Organize your products</p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    <!-- Create Category Form -->
    <div class="bg-white rounded-2xl border border-slate-200 p-6 mb-6">
        <h2 class="text-lg font-semibold text-slate-900 mb-4">Add New Category</h2>
        <form method="POST" action="{{ route('merchant.inventory.categories.store') }}" class="flex gap-4">
            @csrf
            <input 
                type="text" 
                name="name" 
                placeholder="Category name (e.g., Electronics)"
                required
                class="flex-1 px-4 py-3 rounded-xl border-2 border-slate-200 focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition"
            >
            <button 
                type="submit"
                class="px-6 py-3 bg-slate-900 text-white font-semibold rounded-xl hover:bg-slate-800 transition"
            >
                Add Category
            </button>
        </form>
        @error('name')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Categories List -->
    <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
        @if($categories->count() > 0)
            <div class="divide-y divide-slate-200">
                @foreach($categories as $category)
                    <div class="flex items-center justify-between p-6">
                        <div class="flex items-center gap-4 flex-1">
                            <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-600 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-slate-900">{{ $category->name }}</h3>
                                <p class="text-sm text-slate-500">{{ $category->products_count }} products</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <!-- Edit Form (Inline) -->
                            <button 
                                type="button"
                                onclick="toggleEdit({{ $category->id }})"
                                class="p-2 text-slate-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition"
                                title="Edit"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </button>

                            <!-- Delete Form -->
                            <form method="POST" action="{{ route('merchant.inventory.categories.destroy', $category) }}" onsubmit="return confirm('Delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit"
                                    class="p-2 text-slate-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                                    title="Delete"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Hidden Edit Form -->
                    <div id="edit-{{ $category->id }}" class="hidden px-6 py-4 bg-slate-50 border-t border-slate-200">
                        <form method="POST" action="{{ route('merchant.inventory.categories.update', $category) }}" class="flex gap-4">
                            @csrf
                            @method('PUT')
                            <input 
                                type="text" 
                                name="name" 
                                value="{{ $category->name }}"
                                required
                                class="flex-1 px-4 py-2 rounded-lg border-2 border-slate-200 focus:border-brand-600 focus:ring-4 focus:ring-brand-600/10 outline-none transition"
                            >
                            <button 
                                type="submit"
                                class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition"
                            >
                                Update
                            </button>
                            <button 
                                type="button"
                                onclick="toggleEdit({{ $category->id }})"
                                class="px-4 py-2 bg-slate-200 text-slate-700 font-semibold rounded-lg hover:bg-slate-300 transition"
                            >
                                Cancel
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-12 text-center text-slate-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-16 h-16 mx-auto text-slate-300 mb-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                </svg>
                <p>No categories yet. Create one to organize your products.</p>
            </div>
        @endif
    </div>

</div>

<script>
function toggleEdit(id) {
    const editForm = document.getElementById('edit-' + id);
    editForm.classList.toggle('hidden');
}
</script>

@endsection
