<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    //
    public function index(string $shop_slug)
    {
        $tenant = \App\Models\Tenant::where('slug', $shop_slug)->with(['owner'])->firstOrFail();
        
        // Scope products to this tenant
        $products = \App\Models\Product::where('tenant_id', $tenant->id)
            ->where('is_visible', true)
            ->with('category')
            ->latest()
            ->get();

        return view('storefront.home', compact('tenant', 'products'));
    }
}
