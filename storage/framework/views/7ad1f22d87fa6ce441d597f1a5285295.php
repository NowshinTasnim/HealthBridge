<?php $__env->startSection('content'); ?>
<div class="p-6">
    <div class = "container">
        <!-- Total number -->
        <div class= "text-right" style="margin-right: 15px;">
            <h5> Total Number: 3</h5>
            
        </div>

        <!-- Table -->
        <div class ="row justify-content-center" style="margin-top: 40px;">

            <table class="w-3-table w3-bordered w3-card-4 center" style="width: 100%;">
                <thead style="background-color:blueviolet; height: 45px;">
                    <tr >
                        <th class="text-white">First Name</th>
                        <th class="text-white">Last Name</th>
                        <th class="text-white">Contact No.</th>
                        <th class="text-white">Status</th>
                        <th class="text-white">Test Name</th>
                        <th class="text-white">Appointment Date</th>
                    </tr>
                </thead>
                
            </table>
        </div>
    </div>

    
        
        
    </div>



</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.lab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Xampp\htdocs\HealthBridge\resources\views/Lab/patient_list.blade.php ENDPATH**/ ?>