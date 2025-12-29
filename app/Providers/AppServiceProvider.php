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
                        background: rgba(255, 255, 255, 0.8) !important;
                        backdrop-filter: blur(20px) !important;
                        -webkit-backdrop-filter: blur(20px) !important;
                        border-radius: 1.5rem !important;
                        border: 1px solid rgba(255, 255, 255, 0.6) !important;
                        box-shadow: 
                            0 10px 40px -10px rgba(0,0,0,0.05),
                            0 0 0 1px rgba(0,0,0,0.02) !important;
                        padding: 2.5rem !important;
                        max-width: 440px !important;
                    }
                    
                    /* Brand Name / Logo */
                    .fi-logo { 
                        font-weight: 800 !important; 
                        letter-spacing: -0.02em !important; 
                        font-size: 2.25rem !important; 
                        color: #0f172a !important; /* Slate-900 */
                        text-align: center;
                        margin-bottom: 0.25rem;
                    }

                    /* Heading "Sign in" */
                    .fi-simple-header-heading {
                        font-weight: 500 !important;
                        color: #64748b !important;
                        text-align: center;
                        font-size: 1.1rem !important;
                        margin-bottom: 2rem !important;
                    }

                    /* Input Fields */
                    .fi-input-wrp {
                        border-radius: 0.75rem !important;
                        background-color: #ffffff !important;
                        border: 1px solid #cbd5e1 !important;
                        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
                        transition: all 0.2s ease-in-out;
                    }
                    .fi-input-wrp:focus-within {
                        border-color: #0f172a !important; /* Slate-900 */
                        box-shadow: 0 0 0 2px rgba(15, 23, 42, 0.1) !important;
                    }
                    input.fi-input {
                        font-family: "Outfit", sans-serif !important;
                        font-weight: 500 !important;
                        color: #1e293b !important;
                        padding-left: 1rem !important;
                    }

                    /* Labels */
                    .fi-fo-field-wrp-label {
                        font-weight: 700 !important;
                        color: #334155 !important;
                        font-size: 0.8rem !important;
                        text-transform: uppercase !important;
                        letter-spacing: 0.05em !important;
                        margin-bottom: 0.5rem !important;
                    }

                    /* Primary Button (Sign in) - High Specificity */
                    button.fi-btn-primary, 
                    .fi-btn.fi-btn-primary,
                    button[type="submit"] {
                        border-radius: 0.75rem !important;
                        background-color: #0f172a !important; /* Slate-900 */
                        color: #ffffff !important;
                        font-weight: 700 !important;
                        padding: 0.75rem 1.5rem !important;
                        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
                        transition: all 0.2s ease !important;
                        border: 1px solid #0f172a !important;
                        text-transform: uppercase;
                        letter-spacing: 0.05em;
                        font-size: 0.875rem !important;
                        width: 100% !important; /* Full width button */
                        display: flex;
                        justify-content: center;
                        align-items: center;
                    }
                    button.fi-btn-primary:hover,
                    .fi-btn.fi-btn-primary:hover,
                    button[type="submit"]:hover {
                        transform: translateY(-1px);
                        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
                        background-color: #1e293b !important;
                    }
                    
                    /* Hide unnecessary icon in button if present */
                    .fi-btn-primary .fi-btn-icon {
                        display: none;
                    }

                    /* Footer Links */
                    .fi-simple-layout-footer { 
                        color: #94a3b8 !important; 
                        font-size: 0.8rem !important; 
                        margin-top: 2rem !important;
                        text-align: center;
                    }
                    .fi-link {
                         color: #0f172a !important;
                         font-weight: 600 !important;
                         text-decoration: underline !important;
                         text-underline-offset: 4px;
                    }
                </style>
                <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
            ',
        );
    }
}
