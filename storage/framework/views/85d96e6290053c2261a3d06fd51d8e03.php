<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthBridge - Streamline Your Diagnostic Journey</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="<?php echo e(route('home')); ?>" class="flex items-center space-x-2">
                    <div class="flex items-center">
                        <img src="<?php echo e(asset('images/health-bridge-logo.png')); ?>" alt="HealthBridge" class="h-8 w-auto">
                        
                    </div>
                </a>
                <div class="flex items-center space-x-4">
                    <a href="<?php echo e(route('signup')); ?>" class="bg-purple-800 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">Sign Up</a>
                    <a href="<?php echo e(route('login')); ?>" class="border border-purple-800 text-purple-800 px-4 py-2 rounded-lg hover:bg-purple-50 transition">Log In</a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="bg-purple-900 text-white py-4 mt-20">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Healthbridge. All rights reserved</p>
        </div>
    </footer>
</body>
</html>
<?php /**PATH D:\Xampp\htdocs\HealthBridge\resources\views/layouts/app.blade.php ENDPATH**/ ?>