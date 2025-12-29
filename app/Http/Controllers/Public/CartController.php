<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tenant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the shopping cart.
     */
    public function index($shop_slug)
    {
        $tenant = Tenant::where('slug', $shop_slug)
            ->where('is_active', true)
            ->firstOrFail();

        $cart = session()->get("cart_{$tenant->id}", []);
        
        $cartItems = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product && $product->tenant_id == $tenant->id) {
                $subtotal = $product->price * $quantity;
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal,
                ];
                $total += $subtotal;
            }
        }

        return view('public.cart.index', compact('tenant', 'cartItems', 'total'));
    }

    /**
     * Add product to cart.
     */
    public function add(Request $request, $shop_slug)
    {
        $tenant = Tenant::where('slug', $shop_slug)
            ->where('is_active', true)
            ->firstOrFail();

        $product = Product::where('tenant_id', $tenant->id)
            ->findOrFail($request->product_id);

        $quantity = $request->input('quantity', 1);

        $cart = session()->get("cart_{$tenant->id}", []);

        if (isset($cart[$product->id])) {
            $cart[$product->id] += $quantity;
        } else {
            $cart[$product->id] = $quantity;
        }

        session()->put("cart_{$tenant->id}", $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    /**
     * Update cart item quantity.
     */
    public function update(Request $request, $shop_slug)
    {
        $tenant = Tenant::where('slug', $shop_slug)->firstOrFail();
        
        $cart = session()->get("cart_{$tenant->id}", []);
        
        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id] = $request->quantity;
            session()->put("cart_{$tenant->id}", $cart);
        }

        return redirect()->back()->with('success', 'Cart updated!');
    }

    /**
     * Remove item from cart.
     */
    public function remove($shop_slug, $product_id)
    {
        $tenant = Tenant::where('slug', $shop_slug)->firstOrFail();
        
        $cart = session()->get("cart_{$tenant->id}", []);
        
        if (isset($cart[$product_id])) {
            unset($cart[$product_id]);
            session()->put("cart_{$tenant->id}", $cart);
        }

        return redirect()->back()->with('success', 'Item removed from cart!');
    }

    /**
     * Clear entire cart.
     */
    public function clear($shop_slug)
    {
        $tenant = Tenant::where('slug', $shop_slug)->firstOrFail();
        session()->forget("cart_{$tenant->id}");

        return redirect()->route('storefront.index', $shop_slug)
            ->with('success', 'Cart cleared!');
    }
}
