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
                        <input type="text" id="searchInput"
                               placeholder="Search for Patient"
                               class="w-64 px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-purple-500"
                               onkeyup="searchPatient('<?php echo e($page); ?>')">
                    </div>

                    <!-- Contact Us -->
                    <div class="relative flex items-center contact-us-box">
                        <img src="<?php echo e(asset('images/msg.png')); ?>" alt="Message Icon" class="contact-icon" style="height: 15px;">
                        <a href="mailto:snehakhan52@gmail.com?subject=Support%20Request&body=Hi%20Team,%0A%0AI%20need%20help%20with..." class="contact-us-text" style="text-decoration: none;">Contact</a>
                    </div>
                    


                    <!-- Lab Profile -->
                    <div class="relative">
                        
                        <div class="flex flex-col items-center pointer-events-auto">
                            <!-- Go to Profile page-->
                            <a href="<?php echo e(route('Lab.profile')); ?>"><img src="<?php echo e(asset('images/icon1.png')); ?>" alt="Lab"></a>
                            <span class="text-sm text-gray-700"><?php echo e($log); ?></span>
                        </div>

                        
                    </div>

                    <!-- LogOut -->
                    <div class="relative flex items-center">
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit">
                                <img src="<?php echo e(asset('images/arrow.png')); ?>" alt="logout" style="height: 30px; width: auto;">
                            </button>
                        </form>
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
            <hr class= "Custom_line2">
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
                <script>
                    function searchPatient(pageN) {
                        const searchQuery = document.getElementById('searchInput').value;

                        // Send an AJAX request to fetch filtered patient data
                        $.ajax({
                            url: "<?php echo e(route('Lab.patient_list.search')); ?>", // Use the same route for both pages
                            type: "GET",
                            data: {
                                query: searchQuery, // Pass the search query
                                page: pageN,         // Pass the current page
                            },
                            success: function (response) {
                                let tableBody = '';

                                response.forEach(patient => {
                                    if (pageN === "Patient_list") {
                                        // Render table for Patient_list
                                        tableBody += `
                                        <tr style="color: #3b0764; text-align:center;">
                                            <td>${patient.Patient_Name}</td>
                                            <td>${patient.Phone_Number}</td>
                                            <td>
                                                ${patient.Test_Status === 'Done' ? `
                                                    <span class="text-green-500 font-bold">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        Done
                                                    </span>` : `
                                                    <input type="checkbox" class="status-checkbox" value="${patient.Appointment_ID}" onclick="updateStatus('${patient.Appointment_ID}')">
                                                `}
                                            </td>
                                            <td>${patient.Test_Name}</td>
                                            <td>${patient.Appointment_Date}</td>
                                        </tr>
                                        `;
                                    } else if (pageN === "Upload_reports") {
                                        // Render table for Upload_reports
                                        tableBody += `
                                            <tr style="color: #3b0764; text-align:center;">
                                                <td>${patient.Patient_Name}</td>
                                                <td>${patient.Phone_Number}</td>
                                                <td>${patient.Test_Name}</td>
                                                <td>${patient.Appointment_Date}</td>
                                                <td>
                                                    <button onclick="openReportModal('${patient.Patient_Name }', '${patient.Patient_ID }', '${patient.Lab_ID }','${patient.Appointment_ID}')"
                                                        style="margin: auto;"
                                                        class="bg-purple-800 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors flex items-center space-x-2">
                                                        <span>Upload</span>
                                                    </button>
                                                </td>
                                            </tr>
                                        `;
                                    } else if (pageN === "Upload_bills") {
                                        // Render table for Upload_reports
                                        tableBody += `
                                            <tr style="color: #3b0764; text-align:center;">
                                                <td>${patient.Patient_Name }</td>
                                                <td>${patient.Phone_Number }</td>
                                                <td>${patient.Test_Name }</td>
                                                <td>${patient.Appointment_Date }</td>
                                                <td>
                                                    <button onclick="openBillModal('${patient.Patient_Name }', '${patient.Patient_ID }', '${patient.Lab_ID}','${patient.Appointment_ID}')"
                                                        style="margin: auto;"
                                                        class="bg-purple-800 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors flex items-center space-x-2">
                                                        <span>Upload</span>
                                                    </button>
                                                </td>
                                            </tr>
                                        `;
                                    }
                                });

                                document.querySelector('tbody').innerHTML = tableBody;
                            },
                            error: function (error) {
                                console.error('Error fetching patient data:', error);
                            }
                        });
                    }
                </script>

            </main>
        </div>


    </div>



</body>
</html>
<?php /**PATH D:\XAMPP\htdocs\HealthBridge\HealthBridge\resources\views/layouts/lab.blade.php ENDPATH**/ ?>