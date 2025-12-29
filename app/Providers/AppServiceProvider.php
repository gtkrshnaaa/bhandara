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
                        background: rgba(255, 255, 255, 0.9) !important; /* increased opacity for cleanness */
                        backdrop-filter: blur(32px) !important;
                        -webkit-backdrop-filter: blur(32px) !important;
                        border-radius: 24px !important;
                        border: 1px solid rgba(255, 255, 255, 1) !important;
                        box-shadow: 
                            0 24px 60px -12px rgba(0,0,0,0.06),
                            0 12px 24px -8px rgba(0,0,0,0.04) !important;
                        padding: 3rem !important;
                        max-width: 460px !important;
                    }
                    
                    /* Brand Name / Logo */
                    .fi-logo { 
                        font-family: "Outfit", sans-serif !important;
                        font-weight: 800 !important; 
                        letter-spacing: -0.04em !important; 
                        font-size: 2.5rem !important; 
                        color: #0f172a !important; 
                        text-align: center;
                        margin-bottom: 0.5rem;
                        line-height: 1;
                    }

                    /* Heading "Sign in" */
                    .fi-simple-header-heading {
                        font-weight: 500 !important;
                        color: #64748b !important;
                        text-align: center;
                        font-size: 1.125rem !important;
                        margin-bottom: 2.5rem !important;
                        letter-spacing: -0.01em;
                    }

                    /* Input Fields Wrapper */
                    .fi-input-wrp {
                        border-radius: 12px !important;
                        background-color: #ffffff !important;
                        border: 1.5px solid #e2e8f0 !important;
                        box-shadow: none !important; /* Remove default shadow for cleaner look */
                        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
                        padding-block: 2px !important;
                    }
                    
                    /* Input Active/Focus State - The Clean Outline */
                    .fi-input-wrp:focus-within {
                        border-color: #0f172a !important; /* Solid Slate-900 */
                        box-shadow: 
                            0 0 0 4px rgba(15, 23, 42, 0.08) !important; /* Subtle outer ring */
                        transform: translateY(-1px);
                    }
                    
                    input.fi-input {
                        font-family: "Outfit", sans-serif !important;
                        font-weight: 500 !important;
                        color: #0f172a !important;
                        padding-left: 1rem !important;
                        font-size: 1rem !important;
                    }
                    
                    /* Placeholder Styling */
                    input.fi-input::placeholder {
                        color: #94a3b8 !important;
                        font-weight: 400 !important;
                    }

                    /* Labels */
                    .fi-fo-field-wrp-label {
                        font-weight: 700 !important;
                        color: #334155 !important;
                        font-size: 0.75rem !important;
                        text-transform: uppercase !important;
                        letter-spacing: 0.08em !important;
                        margin-bottom: 0.75rem !important;
                    }
                    
                    /* Checkbox */
                    input[type="checkbox"] {
                        border-radius: 6px !important;
                        border-color: #cbd5e1 !important;
                        color: #0f172a !important; /* Checkbox active color */
                        width: 1.125rem !important;
                        height: 1.125rem !important;
                    }
                    input[type="checkbox"]:focus {
                        box-shadow: 0 0 0 2px rgba(15, 23, 42, 0.1) !important;
                    }

                    /* Primary Button (Sign in) */
                    button.fi-btn-primary, 
                    .fi-btn.fi-btn-primary,
                    button[type="submit"] {
                        border-radius: 12px !important;
                        background-color: #0f172a !important; 
                        color: #ffffff !important;
                        font-weight: 700 !important;
                        padding: 1rem 1.5rem !important; /* Larger touch target */
                        font-size: 0.95rem !important;
                        letter-spacing: 0.025em;
                        box-shadow: 0 10px 20px -5px rgba(15, 23, 42, 0.25) !important;
                        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
                        border: 1px solid transparent !important;
                        margin-top: 1rem;
                    }
                    
                    button.fi-btn-primary:hover,
                    .fi-btn.fi-btn-primary:hover,
                    button[type="submit"]:hover {
                        transform: translateY(-2px);
                        box-shadow: 0 20px 30px -10px rgba(15, 23, 42, 0.3) !important;
                        background-color: #000000 !important;
                        border-color: #1e293b !important;
                    }
                    
                     /* Hide unnecessary icon in button if present */
                    .fi-btn-primary .fi-btn-icon {
                        display: none;
                    }

                    /* Footer Links */
                    .fi-simple-layout-footer { 
                        color: #64748b !important; 
                        font-size: 0.875rem !important; 
                        margin-top: 2.5rem !important;
                        text-align: center;
                        font-weight: 500;
                    }
                    .fi-link {
                         color: #0f172a !important;
                         font-weight: 700 !important;
                         text-decoration: none !important;
                         transition: color 0.2s;
                    }
                    .fi-link:hover {
                        color: #4f46e5 !important;
                    }
                </style>
                <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
            ',
        );
    }
}
