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
                       /* Modern mesh gradient background */
                        background-image: 
                            radial-gradient(at 0% 0%, hsla(253,16%,7%,0.02) 0, transparent 50%), 
                            radial-gradient(at 50% 0%, hsla(225,39%,30%,0.02) 0, transparent 50%), 
                            radial-gradient(at 100% 0%, hsla(339,49%,30%,0.02) 0, transparent 50%);
                        background-size: 100% 100%;
                        background-repeat: no-repeat;
                    }
                    /* Subtle grid texture */
                    body::before {
                        content: "";
                        position: fixed;
                        inset: 0;
                        background-image: linear-gradient(#e2e8f0 1px, transparent 1px), linear-gradient(90deg, #e2e8f0 1px, transparent 1px);
                        background-size: 40px 40px;
                        opacity: 0.4;
                        z-index: -1;
                        pointer-events: none;
                        mask-image: linear-gradient(to bottom, rgba(0,0,0,1) 0%, rgba(0,0,0,0) 100%);
                    }

                    /* --- FILAMENT LOGIN CARD OVERRIDES --- */
                    
                    /* The Main Card Container */
                    .fi-simple-main {
                        background: rgba(255, 255, 255, 0.65) !important;
                        backdrop-filter: blur(24px) !important;
                        -webkit-backdrop-filter: blur(24px) !important;
                        border-radius: 2rem !important; /* Super rounded */
                        border: 1px solid rgba(255, 255, 255, 0.8) !important;
                        box-shadow: 
                            0 20px 50px -12px rgba(0,0,0,0.03),
                            0 4px 10px -2px rgba(0,0,0,0.02) !important;
                        padding: 2.5rem !important;
                        max-width: 480px !important;
                    }
                    
                    /* Brand Name / Logo */
                    .fi-logo { 
                        font-weight: 800 !important; 
                        letter-spacing: -0.03em !important; 
                        font-size: 2rem !important; 
                        color: #0f172a !important; /* Slate-900 */
                        text-align: center;
                        margin-bottom: 0.5rem;
                    }

                    /* Heading "Sign in" */
                    .fi-simple-header-heading {
                        font-weight: 700 !important;
                        color: #334155 !important;
                        text-align: center;
                        font-size: 1.25rem !important;
                    }

                    /* Input Fields */
                    .fi-input-wrp {
                        border-radius: 1rem !important;
                        background-color: rgba(255,255,255, 0.7) !important;
                        border: 1px solid #e2e8f0 !important;
                        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
                        transition: all 0.2s ease-in-out;
                    }
                    .fi-input-wrp:focus-within {
                        border-color: #6366f1 !important; /* Indigo-500 */
                        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1) !important;
                        background-color: #ffffff !important;
                    }
                    input.fi-input {
                        font-family: 'Outfit', sans-serif !important;
                        font-weight: 500 !important;
                        color: #1e293b !important;
                        padding-left: 1.25rem !important;
                    }

                    /* Labels */
                    .fi-fo-field-wrp-label {
                        font-weight: 600 !important;
                        color: #64748b !important; /* Slate-500 */
                        font-size: 0.875rem !important;
                        margin-bottom: 0.5rem !important;
                    }

                    /* Primary Button (Sign in) */
                    .fi-btn-primary {
                        border-radius: 1rem !important;
                        background-color: #0f172a !important; /* Slate-900 */
                        color: white !important;
                        font-weight: 700 !important;
                        padding: 0.75rem 1.5rem !important;
                        box-shadow: 0 10px 20px -10px rgba(15, 23, 42, 0.5) !important;
                        transition: all 0.2s ease !important;
                        border: none !important;
                    }
                    .fi-btn-primary:hover {
                        transform: translateY(-2px);
                        box-shadow: 0 15px 30px -10px rgba(15, 23, 42, 0.6) !important;
                        background-color: #000000 !important;
                    }

                    /* Footer Links */
                    .fi-simple-layout-footer { 
                        color: #94a3b8 !important; 
                        font-size: 0.8rem !important; 
                        margin-top: 2rem !important;
                    }
                    .fi-link {
                         color: #6366f1 !important;
                         font-weight: 600 !important;
                    }
                </style>
                <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
            ',
        );
    }
}
