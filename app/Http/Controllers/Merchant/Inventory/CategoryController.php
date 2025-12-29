<?php

namespace App\Http\Controllers\Merchant\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index()
    {
        $tenant = Auth::user()->tenants()->first();
        
        if (!$tenant) {
            return redirect()->route('merchant.dashboard')
                ->with('error', 'You need to create a shop first.');
        }

        $categories = Category::where('tenant_id', $tenant->id)
            ->withCount('products')
            ->get();

        return view('merchant.inventory.categories.index', compact('categories', 'tenant'));
    }

    /**
     * Store a newly created category.
     */
    public function store(Request $request)
    {
        $tenant = Auth::user()->tenants()->first();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $validated['tenant_id'] = $tenant->id;
        $validated['slug'] = Str::slug($validated['name']);

        Category::create($validated);

        return redirect()->route('merchant.inventory.categories.index')
            ->with('success', 'Category created successfully!');
    }

    /**
     * Update the specified category.
     */
    public function update(Request $request, Category $category)
    {
        $tenant = Auth::user()->tenants()->first();
        
        if ($category->tenant_id !== $tenant->id) {
            abort(403, 'Unauthorized access to this category.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return redirect()->route('merchant.inventory.categories.index')
            ->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified category.
     */
    public function destroy(Category $category)
    {
        $tenant = Auth::user()->tenants()->first();
        
        if ($category->tenant_id !== $tenant->id) {
            abort(403, 'Unauthorized access to this category.');
        }

        $category->delete();

        return redirect()->route('merchant.inventory.categories.index')
            ->with('success', 'Category deleted successfully!');
    }
}
