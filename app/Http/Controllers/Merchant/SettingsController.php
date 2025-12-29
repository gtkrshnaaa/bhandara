<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    /**
     * Show settings page.
     */
    public function index()
    {
        $tenant = Auth::user()->tenants()->first();
        
        if (!$tenant) {
            return redirect()->route('merchant.dashboard')
                ->with('error', 'You need to create a shop first.');
        }

        return view('merchant.settings.index', compact('tenant'));
    }

    /**
     * Update shop settings.
     */
    public function update(Request $request)
    {
        $tenant = Auth::user()->tenants()->first();
        
        if (!$tenant) {
            return redirect()->route('merchant.dashboard');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'primary_color' => 'nullable|string|max:7',
        ]);

        $tenant->update($validated);

        return redirect()->route('merchant.settings.index')
            ->with('success', 'Settings updated successfully!');
    }
}
