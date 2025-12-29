<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display list of customers for merchant's tenant.
     */
    public function index()
    {
        $tenant = Auth::user()->tenants()->first();
        
        if (!$tenant) {
            return redirect()->route('merchant.dashboard')
                ->with('error', 'You need to create a shop first.');
        }

        $customers = Customer::where('tenant_id', $tenant->id)
            ->withCount('orders')
            ->latest()
            ->paginate(15);

        return view('merchant.customers.index', compact('customers', 'tenant'));
    }

    /**
     * Display customer details with order history.
     */
    public function show(Customer $customer)
    {
        $tenant = Auth::user()->tenants()->first();
        
        if ($customer->tenant_id !== $tenant->id) {
            abort(403, 'Unauthorized access to this customer.');
        }

        $customer->load('orders');

        return view('merchant.customers.show', compact('customer', 'tenant'));
    }
}
