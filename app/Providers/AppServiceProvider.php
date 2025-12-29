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
                        background-color: #f8fafc !important;
                        background-image: radial-gradient(at 0% 0%, hsla(253,16%,7%,0) 0, transparent 50%), radial-gradient(at 50% 0%, hsla(225,39%,30%,0) 0, transparent 50%), radial-gradient(at 100% 0%, hsla(339,49%,30%,0) 0, transparent 50%);
                        background-size: 100% 100%;
                        background-repeat: no-repeat;
                    }
                    /* Add a subtle dot pattern overlay */
                    body::before {
                        content: "";
                        position: fixed;
                        top: 0; left: 0; width: 100%; height: 100%;
                        background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
                        background-size: 24px 24px;
                        opacity: 0.4;
                        z-index: -1;
                        pointer-events: none;
                    }
                    
                    /* Glassmorphism for Filament Login Card - Light Mode */
                    .fi-simple-main {
                        background: rgba(255, 255, 255, 0.75) !important;
                        backdrop-filter: blur(24px) !important;
                        -webkit-backdrop-filter: blur(24px) !important;
                        border-radius: 1.5rem !important;
                        border: 1px solid rgba(255, 255, 255, 0.6) !important;
                        box-shadow: 0 20px 50px -12px rgba(0,0,0,0.05) !important;
                    }
                    /* Typography Polish */
                    .fi-logo { font-weight: 800 !important; letter-spacing: -0.025em !important; font-size: 1.5rem !important; }
                    .fi-simple-layout-footer { color: #64748b !important; font-size: 0.8rem !important; }
                </style>
                <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
            ',
        );
    }
}
