<?php

namespace App\Http\Controllers\Merchant\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of products for current tenant.
     */
    public function index()
    {
        // Get current user's first tenant (for now)
        $tenant = Auth::user()->tenants()->first();
        
        if (!$tenant) {
            return redirect()->route('merchant.dashboard')
                ->with('error', 'You need to create a shop first.');
        }

        $products = Product::where('tenant_id', $tenant->id)
            ->with('category')
            ->latest()
            ->paginate(12);

        return view('merchant.inventory.products.index', compact('products', 'tenant'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $tenant = Auth::user()->tenants()->first();
        
        if (!$tenant) {
            return redirect()->route('merchant.dashboard')
                ->with('error', 'You need to create a shop first.');
        }

        $categories = Category::where('tenant_id', $tenant->id)->get();

        return view('merchant.inventory.products.create', compact('categories', 'tenant'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $tenant = Auth::user()->tenants()->first();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'sku' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'is_visible' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $validated['tenant_id'] = $tenant->id;
        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_visible'] = $request->has('is_visible');
        $validated['is_featured'] = $request->has('is_featured');

        Product::create($validated);

        return redirect()->route('merchant.inventory.products.index')
            ->with('success', 'Product created successfully!');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        $tenant = Auth::user()->tenants()->first();
        
        // Ensure product belongs to current tenant
        if ($product->tenant_id !== $tenant->id) {
            abort(403, 'Unauthorized access to this product.');
        }

        $categories = Category::where('tenant_id', $tenant->id)->get();

        return view('merchant.inventory.products.edit', compact('product', 'categories', 'tenant'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $tenant = Auth::user()->tenants()->first();
        
        if ($product->tenant_id !== $tenant->id) {
            abort(403, 'Unauthorized access to this product.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'sku' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'is_visible' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_visible'] = $request->has('is_visible');
        $validated['is_featured'] = $request->has('is_featured');

        $product->update($validated);

        return redirect()->route('merchant.inventory.products.index')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        $tenant = Auth::user()->tenants()->first();
        
        if ($product->tenant_id !== $tenant->id) {
            abort(403, 'Unauthorized access to this product.');
        }

        $product->delete();

        return redirect()->route('merchant.inventory.products.index')
            ->with('success', 'Product deleted successfully!');
    }
}
