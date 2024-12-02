<?php $__env->startSection('content'); ?>
<div class="container_start">
    <div class = "container">
        <!-- Total number -->
        <div class= "text-right" style="margin-right: 10px;">
            
            <h5> Total Number: <?php echo e($patients->count()); ?></h5>
        </div>

        <!-- Table -->
        <div class ="row justify-content-center" style="margin-top: 40px;">

            <table class="w-3-table w3-bordered w3-card-4 center" style="width: 100%;">
                <thead style="background-color:#7e22ce; height: 45px;">
                    <tr >
                        <th class="text-white">Patient Name</th>
                        <th class="text-white">Contact No.</th>
                        <th class="text-white">Completed?</th>
                        <th class="text-white">Test Name</th>
                        <th class="text-white">Appointment Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr style="color: #3b0764; text-align:center;">
                            <td><?php echo e($patient->Patient_Name); ?></td>
                            <td><?php echo e($patient->Phone_Number); ?></td>
                            <td>
                                <?php if($patient->Test_Status == 'Done'): ?>
                                    <span class="text-green-500 font-bold">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Done
                                    </span>
                                <?php else: ?>
                                    <input type="checkbox" class="status-checkbox" value="<?php echo e($patient->Appointment_ID); ?>" onclick="updateStatus('<?php echo e($patient->Appointment_ID); ?>')">
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($patient->Test_Name); ?></td>
                            <td><?php echo e($patient->Appointment_Date); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function updateStatus(appointmentId) {
        // Reference the clicked checkbox
        const checkbox = document.querySelector(`.status-checkbox[value="${appointmentId}"]`);

        // Display a confirmation dialog
        if (confirm("Are you sure you want to mark this test as Done?")) {
            // If user confirms, proceed with the AJAX request
            $.ajax({
                url: "<?php echo e(route('Lab.patient_list.markAsDone')); ?>",
                type: "POST",
                data: {
                    _token: "<?php echo e(csrf_token()); ?>",
                    appointmentId: appointmentId
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        location.reload(); // Optionally reload the page
                    } else {
                        alert('Failed to update status: ' + response.message);
                        ccheckbox.checked = false; // Revert checkbox on error
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                    checkbox.checked = false; // Revert checkbox on error
                }
            });
        } else {
            // If user cancels, uncheck the checkbox
            // this.checked = false;
            checkbox.checked = false;
        }
    }
</script>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.lab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\HealthBridge\HealthBridge\resources\views/Lab/patient_list.blade.php ENDPATH**/ ?>