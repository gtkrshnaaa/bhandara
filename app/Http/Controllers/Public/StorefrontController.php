<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class StorefrontController extends Controller
{
    /**
     * Display the storefront homepage for a tenant.
     */
    public function index($shop_slug)
    {
        $tenant = Tenant::where('slug', $shop_slug)
            ->where('is_active', true)
            ->firstOrFail();

        $featuredProducts = Product::where('tenant_id', $tenant->id)
            ->where('is_visible', true)
            ->where('is_featured', true)
            ->limit(4)
            ->get();

        $latestProducts = Product::where('tenant_id', $tenant->id)
            ->where('is_visible', true)
            ->latest()
            ->limit(8)
            ->get();

        $categories = Category::where('tenant_id', $tenant->id)
            ->withCount(['products' => function($query) {
                $query->where('is_visible', true);
            }])
            ->having('products_count', '>', 0)
            ->get();

        return view('public.storefront.index', compact('tenant', 'featuredProducts', 'latestProducts', 'categories'));
    }

    /**
     * Display products by category.
     */
    public function category($shop_slug, $category_slug)
    {
        $tenant = Tenant::where('slug', $shop_slug)
            ->where('is_active', true)
            ->firstOrFail();

        $category = Category::where('tenant_id', $tenant->id)
            ->where('slug', $category_slug)
            ->firstOrFail();

        $products = Product::where('tenant_id', $tenant->id)
            ->where('category_id', $category->id)
            ->where('is_visible', true)
            ->paginate(12);

        $categories = Category::where('tenant_id', $tenant->id)
            ->withCount(['products' => function($query) {
                $query->where('is_visible', true);
            }])
            ->having('products_count', '>', 0)
            ->get();

        return view('public.storefront.category', compact('tenant', 'category', 'products', 'categories'));
    }

    /**
     * Display a single product.
     */
    public function product($shop_slug, $product_slug)
    {
        $tenant = Tenant::where('slug', $shop_slug)
            ->where('is_active', true)
            ->firstOrFail();

        $product = Product::where('tenant_id', $tenant->id)
            ->where('slug', $product_slug)
            ->where('is_visible', true)
            ->with('category')
            ->firstOrFail();

        $relatedProducts = Product::where('tenant_id', $tenant->id)
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_visible', true)
            ->limit(4)
            ->get();

        return view('public.storefront.product', compact('tenant', 'product', 'relatedProducts'));
    }
}
