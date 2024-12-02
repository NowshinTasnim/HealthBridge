<!-- resources/views/layouts/lab.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>HealthBridge Lab</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="<?php echo e(asset('css/lab.css')); ?>">
</head>
<body class="bg-gray-50">
    <!-- Header/Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="head_part">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center">
                    <img src="<?php echo e(asset('images/HealthBridgeLogo.png')); ?>" alt="HealthBridge" style="height: 40px;" >
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


                    <!-- Lab Profile -->
                    <div class="relative" x-data="{ open: false }">
                        <div class="flex flex-col items-center pointer-events-auto" @click="open = !open">
                            <img src="<?php echo e(asset('images/icon1.png')); ?>" alt="Lab">
                            <span class="text-sm text-gray-700">Lab</span>
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
                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
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
            <a href="<?php echo e(route('Lab.dashboard')); ?>"
               class="flex items-center space-x-2 px-4 py-4 <?php echo e(request()->routeIs('Lab.dashboard') ? 'bg-purple-900' : 'hover:bg-purple-700'); ?>">
               <img src="<?php echo e(asset('images/dashboard.png')); ?>" alt="Dashboard" style="width: 20px;" >
                
                <span class="font-semibold">Dashboard</span>
            </a>

            <hr class= "Custom_line">
            <!-- Side Navigation Section -->
            <div class="mt-6">
                <div class="space-y-1">
                    <a href="<?php echo e(route('Lab.patient_list')); ?>"
                       class="flex items-center space-x-2 px-4 py-2 <?php echo e(request()->routeIs('Lab.patient_list') ? 'bg-purple-900' : 'hover:bg-purple-700'); ?>">
                       <img src="<?php echo e(asset('images/patient.png')); ?>" alt="patient" style="width: 20px;" >
                       
                        <span>Patient List</span>
                    </a>
                    <a href="<?php echo e(route('Lab.upload_reports_view')); ?>"
                       class="flex items-center space-x-2 px-4 py-2 <?php echo e(request()->routeIs('Lab.upload_reports_view') ? 'bg-purple-900' : 'hover:bg-purple-700'); ?>">
                       <img src="<?php echo e(asset('images/medical-reports.png')); ?>" alt="report" style="width: 20px;" >
                       
                        <span>Upload Reports</span>
                    </a>
                    <a href="<?php echo e(route('Lab.upload_bills_view')); ?>"
                       class="flex items-center space-x-2 px-4 py-2 <?php echo e(request()->routeIs('Lab.upload_bills_view') ? 'bg-purple-900' : 'hover:bg-purple-700'); ?>">
                       <img src="<?php echo e(asset('images/bill.png')); ?>" alt="bill" style="width: 20px;" >
                       
                        <span>Upload Bills</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-x-hidden bg-gray-50">
            <main class="main_content">
                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>
</body>
</html>
<?php /**PATH D:\XAMPP\htdocs\HealthBridge\HealthBridge\resources\views/layouts/lab.blade.php ENDPATH**/ ?>