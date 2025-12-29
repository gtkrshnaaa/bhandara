<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// GROUP: PUBLIC STOREFRONT (Tenant Aware)
Route::prefix('u/{shop_slug}')->name('storefront.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Storefront\CatalogController::class, 'index'])->name('home');
});
