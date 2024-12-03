<?php $__env->startSection('content'); ?>
<?php $page = 'Lab_dashboard'; ?>
<div class="w-full h-full p-6" style="margin-top: 40px;">
    <div class="flex flex-col md:flex-row space-y-6 md:space-y-0 md:space-x-6">
        <!-- Claims This Week Chart -->
        <div class="flex-1 bg-white rounded-lg shadow p-6">
            
            <div style="height: 400px; width: 500px;">
                <img src="<?php echo e(asset('images/Lab_dashboard_bar_chart.png')); ?>" alt="barChart">
            </div>
        </div>

        <!-- Accepted Claims Chart -->
        <div class="flex-1 bg-white rounded-lg shadow p-6">
            
            <div style="height: 400px; width: 500px;">
                <img src="<?php echo e(asset('images/Revenue.png')); ?>" alt="barChart"">
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.lab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\HealthBridge\HealthBridge\resources\views/Lab/dashboard.blade.php ENDPATH**/ ?>