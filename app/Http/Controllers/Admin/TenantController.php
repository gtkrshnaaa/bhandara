<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TenantController extends Controller
{
    /**
     * Display a listing of tenants.
     */
    public function index()
    {
        $tenants = Tenant::with('owner')
            ->withCount('products')
            ->latest()
            ->paginate(15);

        return view('admin.tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new tenant.
     */
    public function create()
    {
        $users = User::orderBy('name')->get();
        return view('admin.tenants.create', compact('users'));
    }

    /**
     * Store a newly created tenant.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:tenants,slug',
            'owner_id' => 'required|exists:users,id',
            'primary_color' => 'nullable|string|max:7',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        
        if (empty($validated['primary_color'])) {
            $validated['primary_color'] = '#6366f1';
        }

        Tenant::create($validated);

        return redirect()->route('admin.tenants.index')
            ->with('success', 'Tenant created successfully!');
    }

    /**
     * Show details of a tenant.
     */
    public function show(Tenant $tenant)
    {
        $tenant->load(['owner', 'products', 'orders', 'customers']);
        
        $stats = [
            'products' => $tenant->products()->count(),
            'orders' => $tenant->orders()->count(),
            'customers' => $tenant->customers()->count(),
            'revenue' => $tenant->orders()->sum('total_price'),
        ];

        return view('admin.tenants.show', compact('tenant', 'stats'));
    }

    /**
     * Show the form for editing a tenant.
     */
    public function edit(Tenant $tenant)
    {
        $users = User::orderBy('name')->get();
        return view('admin.tenants.edit', compact('tenant', 'users'));
    }

    /**
     * Update the specified tenant.
     */
    public function update(Request $request, Tenant $tenant)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:tenants,slug,' . $tenant->id,
            'owner_id' => 'required|exists:users,id',
            'primary_color' => 'nullable|string|max:7',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $tenant->update($validated);

        return redirect()->route('admin.tenants.index')
            ->with('success', 'Tenant updated successfully!');
    }

    /**
     * Remove the specified tenant.
     */
    public function destroy(Tenant $tenant)
    {
        $tenant->delete();

        return redirect()->route('admin.tenants.index')
            ->with('success', 'Tenant deleted successfully!');
    }

    /**
     * Toggle tenant active status.
     */
    public function toggleStatus(Tenant $tenant)
    {
        $tenant->update(['is_active' => !$tenant->is_active]);

        $status = $tenant->is_active ? 'activated' : 'deactivated';
        
        return redirect()->back()
            ->with('success', "Tenant {$status} successfully!");
    }
}
