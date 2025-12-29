@extends('layouts.admin')

@section('title', 'Error - Admin')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4">
    <div class="max-w-2xl w-full">
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 p-8 md:p-12">
            <!-- Error Icon -->
            <div class="flex justify-center mb-6">
                <div class="p-4 bg-red-100 rounded-full">
                    <svg class="w-16 h-16 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
            </div>
            
            <!-- Error Message -->
            <div class="text-center">
                <h1 class="text-4xl font-bold text-slate-900 mb-4">Oops! Something went wrong</h1>
                
                @if(config('app.debug'))
                    <div class="mb-6 p-4 bg-slate-50 rounded-lg text-left">
                        <p class="text-sm font-semibold text-slate-700 mb-2">Error Details (Debug Mode):</p>
                        <p class="text-xs text-slate-600 font-mono break-all">{{ $message ?? 'Unknown error' }}</p>
                        
                        @if(isset($exception))
                            <div class="mt-4">
                                <p class="text-xs text-slate-500">{{ get_class($exception) }}</p>
                                <p class="text-xs text-slate-500">File: {{ $exception->getFile() }}:{{ $exception->getLine() }}</p>
                            </div>
                        @endif
                    </div>
                @else
                    <p class="text-slate-600 mb-6">
                        We're experiencing technical difficulties. Our team has been notified and is working on it.
                    </p>
                @endif
                
                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center justify-center px-6 py-3 bg-brand-600 text-white font-semibold rounded-lg hover:bg-brand-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Back to Dashboard
                    </a>
                    
                    <button onclick="window.location.reload()" class="inline-flex items-center justify-center px-6 py-3 bg-slate-100 text-slate-700 font-semibold rounded-lg hover:bg-slate-200 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Retry
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
