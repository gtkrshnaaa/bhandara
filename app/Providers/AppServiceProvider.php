<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Inject Tailwind Play CDN for "Futuristic" Theme in Filament Panels
        \Filament\Support\Facades\FilamentView::registerRenderHook(
            'panels::head.end',
            fn (): string => '
                <script src="https://cdn.tailwindcss.com"></script>
                <script>
                    tailwind.config = {
                        theme: {
                            extend: {
                                colors: {
                                    brand: {
                                        50: "#f0f9ff",
                                        100: "#e0f2fe",
                                        500: "#0ea5e9",
                                        600: "#0284c7",
                                        900: "#0c4a6e",
                                    }
                                }
                            }
                        }
                    }
                </script>
                <style>
                    /* Force Tailwind Preflight/Reset if needed, though Filament has its own */
                    body {
                        font-family: "Outfit", sans-serif !important;
                        background-color: #f8fafc !important; /* Slate-50 */
                    }
                    /* Glassmorphism for Filament Login Card - Light Mode */
                    .fi-simple-main {
                        background: rgba(255, 255, 255, 0.85) !important;
                        backdrop-filter: blur(20px) !important;
                        border-radius: 1.5rem !important;
                        border: 1px solid rgba(255, 255, 255, 0.6) !important;
                        box-shadow: 0 10px 40px -10px rgba(0,0,0,0.05) !important;
                    }
                    /* Typography Polish */
                    .fi-logo { font-weight: 800 !important; letter-spacing: -0.025em !important; }
                </style>
                <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
            ',
        );
    }
}
