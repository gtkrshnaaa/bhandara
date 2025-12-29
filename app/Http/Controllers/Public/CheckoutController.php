<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Show checkout form.
     */
    public function index($shop_slug)
    {
        $tenant = Tenant::where('slug', $shop_slug)
            ->where('is_active', true)
            ->firstOrFail();

        $cart = session()->get("cart_{$tenant->id}", []);
        
        if (empty($cart)) {
            return redirect()->route('storefront.cart.index', $shop_slug)
                ->with('error', 'Your cart is empty!');
        }

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

        return view('public.checkout.index', compact('tenant', 'cartItems', 'total'));
    }

    /**
     * Process checkout and create order.
     */
    public function store(Request $request, $shop_slug)
    {
        $tenant = Tenant::where('slug', $shop_slug)->firstOrFail();

        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'payment_proof' => 'nullable|string|max:500',
        ]);

        $cart = session()->get("cart_{$tenant->id}", []);
        
        if (empty($cart)) {
            return redirect()->route('storefront.cart.index', $shop_slug);
        }

        // Create or find customer
        $customer = Customer::firstOrCreate(
            [
                'tenant_id' => $tenant->id,
                'phone' => $validated['customer_phone'],
            ],
            [
                'name' => $validated['customer_name'],
                'address' => $validated['customer_address'],
            ]
        );

        // Calculate totals
        $totalPrice = 0;
        $orderItems = [];

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product && $product->tenant_id == $tenant->id) {
                $totalPrice += $product->price * $quantity;
                $orderItems[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' => $quantity,
                    'price' => $product->price,
                ];
            }
        }

        // Create order
        $order = Order::create([
            'tenant_id' => $tenant->id,
            'customer_id' => $customer->id,
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'total_price' => $totalPrice,
            'status' => 'pending',
            'payment_proof' => $validated['payment_proof'] ?? null,
            'items' => json_encode($orderItems),
        ]);

        // Clear cart
        session()->forget("cart_{$tenant->id}");

        return redirect()->route('storefront.checkout.success', [$shop_slug, $order->id]);
    }

    /**
     * Show order success page.
     */
    public function success($shop_slug, Order $order)
    {
        $tenant = Tenant::where('slug', $shop_slug)->firstOrFail();
        
        if ($order->tenant_id !== $tenant->id) {
            abort(404);
        }

        return view('public.checkout.success', compact('tenant', 'order'));
    }
}
