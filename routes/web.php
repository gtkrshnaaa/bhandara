<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Merchant\DashboardController as MerchantDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes - Following LARAVELDEVCONV.md Clean Route Protocol
|--------------------------------------------------------------------------
| Rules:
| - No closures
| - One line per route
| - Strict grouping by Access Scope > Domain Context
*/

// ROOT: Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// GROUP 1: ADMIN SCOPE
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Scope-Level Routes
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // DOMAIN: Inventory Management
    Route::prefix('inventory')->name('inventory.')->group(function () {
        // Future: Products, Categories resources will be added here
    });
    
    // DOMAIN: Exchange (Order Management)
    Route::prefix('exchange')->name('exchange.')->group(function () {
        // Future: Orders resources will be added here
    });
    
});

// GROUP 2: MERCHANT SCOPE
Route::prefix('merchant')->name('merchant.')->group(function () {
    
    // Scope-Level Routes
    Route::get('/', [MerchantDashboardController::class, 'index'])->name('dashboard');
    
    // Future: Merchant specific routes will be added here
    
});

// GROUP 3: PUBLIC STOREFRONT (Tenant Aware)
Route::prefix('u/{shop_slug}')->name('storefront.')->group(function () {
    // Future: Storefront catalog and checkout routes will be added here
});
