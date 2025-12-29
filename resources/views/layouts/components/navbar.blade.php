<nav class="bg-white border-b border-slate-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo / Brand -->
            <div class="flex items-center">
                <a href="{{ $scope === 'admin' ? route('admin.dashboard') : ($scope === 'merchant' ? route('merchant.dashboard') : '/') }}" class="text-2xl font-bold text-slate-900 tracking-tight">
                    Bhandara
                </a>
            </div>
            
            <!-- Navigation Links -->
            <div class="hidden md:flex space-x-8">
                @if($scope === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="text-slate-700 hover:text-brand-600 px-3 py-2 text-sm font-medium">Dashboard</a>
                    <a href="#" class="text-slate-700 hover:text-brand-600 px-3 py-2 text-sm font-medium">Products</a>
                    <a href="#" class="text-slate-700 hover:text-brand-600 px-3 py-2 text-sm font-medium">Orders</a>
                @elseif($scope === 'merchant')
                    <a href="{{ route('merchant.dashboard') }}" class="text-slate-700 hover:text-brand-600 px-3 py-2 text-sm font-medium">Dashboard</a>
                    <a href="#" class="text-slate-700 hover:text-brand-600 px-3 py-2 text-sm font-medium">My Products</a>
                    <a href="#" class="text-slate-700 hover:text-brand-600 px-3 py-2 text-sm font-medium">Orders</a>
                @else
                    <a href="/" class="text-slate-700 hover:text-brand-600 px-3 py-2 text-sm font-medium">Home</a>
                    <a href="#" class="text-slate-700 hover:text-brand-600 px-3 py-2 text-sm font-medium">Products</a>
                @endif
            </div>
            
            <!-- User Menu -->
            <div class="flex items-center space-x-4">
                @auth
                    <span class="text-sm text-slate-700">{{ auth()->user()->name ?? 'User' }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-slate-700 hover:text-brand-600 font-medium">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-slate-700 hover:text-brand-600 font-medium">Login</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
