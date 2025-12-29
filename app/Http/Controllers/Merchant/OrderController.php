<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display list of orders for merchant's tenant.
     */
    public function index()
    {
        $tenant = Auth::user()->tenants()->first();
        
        if (!$tenant) {
            return redirect()->route('merchant.dashboard')
                ->with('error', 'You need to create a shop first.');
        }

        $orders = Order::where('tenant_id', $tenant->id)
            ->with('customer')
            ->latest()
            ->paginate(15);

        return view('merchant.orders.index', compact('orders', 'tenant'));
    }

    /**
     * Display order details.
     */
    public function show(Order $order)
    {
        $tenant = Auth::user()->tenants()->first();
        
        if ($order->tenant_id !== $tenant->id) {
            abort(403, 'Unauthorized access to this order.');
        }

        $order->load('customer');
        $items = json_decode($order->items, true);

        return view('merchant.orders.show', compact('order', 'items', 'tenant'));
    }

    /**
     * Update order status.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $tenant = Auth::user()->tenants()->first();
        
        if ($order->tenant_id !== $tenant->id) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,paid,processing,shipped,completed,cancelled',
        ]);

        $order->update(['status' => $validated['status']]);

        return redirect()->back()->with('success', 'Order status updated!');
    }
}
