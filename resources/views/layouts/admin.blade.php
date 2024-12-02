<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthBridge Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50">
    <!-- Header/Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <img src="{{ asset('images/health-bridge-logo.png') }}" alt="HealthBridge" class="h-8">
                </div>

                <!-- Search and User Info -->
                <div class="flex items-center space-x-6">
                    <!-- Search -->
                    <div class="relative flex items-center">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <button class="p-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </button>
                        </div>
                        <input type="text"
                               placeholder="Search for..."
                               class="w-64 px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>


                    <!-- Admin Profile -->
                    <div class="relative" x-data="{ open: false }">
                        <div class="flex flex-col items-center pointer-events-auto" @click="open = !open">
                            <img src="{{ asset('images/icon1.png') }}" alt="Admin">
                            <span class="text-sm text-gray-700">Admin</span>
                        </div>

                        <div x-show="open"
                            @click.away="open = false"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-purple-50">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-purple-800 text-white">
            <!-- Dashboard Link -->
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center space-x-2 px-4 py-4 {{ request()->routeIs('admin.dashboard') ? 'bg-purple-900' : 'hover:bg-purple-700' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <span class="font-semibold">Dashboard</span>
            </a>

            <!-- Manage Claims Section -->
            <div class="mt-6">
                <div class="px-4 py-2 text-sm font-medium text-purple-200">Manage Claims</div>
                <div class="space-y-1">
                    <a href="{{ route('admin.request-claim') }}"
                       class="flex items-center space-x-2 px-4 py-2 {{ request()->routeIs('admin.request-claim') ? 'bg-purple-900' : 'hover:bg-purple-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span>Request Claim</span>
                    </a>
                    <a href="{{ route('admin.approved-claims') }}"
                       class="flex items-center space-x-2 px-4 py-2 {{ request()->routeIs('admin.approved-claims') ? 'bg-purple-900' : 'hover:bg-purple-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span>Approved Claims</span>
                    </a>
                    <a href="{{ route('admin.rejected-claims') }}"
                       class="flex items-center space-x-2 px-4 py-2 {{ request()->routeIs('admin.rejected-claims') ? 'bg-purple-900' : 'hover:bg-purple-700' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        <span>Rejected Claims</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-x-hidden bg-gray-50">
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
