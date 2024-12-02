<?php $__env->startSection('content'); ?>
<div class="p-6">
    <div class="max-w-4xl mx-auto space-y-6">
        <?php $__currentLoopData = ['Thomas Brownie', 'Juliette Brownie', 'Danielle Redcliff']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-white rounded-lg shadow hover:shadow-md transition-shadow">
            <div class="p-6 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                        <span class="text-purple-800 font-bold"><?php echo e(substr($patient, 0, 1)); ?></span>
                    </div>
                    <div>
                        <h3 class="font-semibold text-lg"><?php echo e($patient); ?></h3>
                    </div>
                </div>
                <button onclick="openClaimModal()"
                        class="bg-purple-800 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors flex items-center space-x-2">
                    <span>Request Claim</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>


    <div id="claimModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded-lg shadow-xl max-w-lg w-full p-6">
                <h2 class="text-xl font-bold mb-4">Submit Claim Request</h2>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Patient Information</label>
                        <input type="text" class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Claim Details</label>
                        <textarea class="mt-1 block w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500" rows="4"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Attach Documents</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <label class="relative cursor-pointer bg-white rounded-md font-medium text-purple-800 hover:text-purple-700">
                                        <span>Upload a file</span>
                                        <input type="file" class="sr-only">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, PDF up to 10MB</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button onclick="closeClaimModal()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</button>
                    <button class="px-4 py-2 bg-purple-800 text-white rounded-lg hover:bg-purple-700">Submit Claim</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openClaimModal() {
        document.getElementById('claimModal').classList.remove('hidden');
    }

    function closeClaimModal() {
        document.getElementById('claimModal').classList.add('hidden');
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\HealthBridge\HealthBridge\resources\views/admin/request-claim.blade.php ENDPATH**/ ?>