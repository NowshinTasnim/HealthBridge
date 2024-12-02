<script>
    function searchPatient(page) {
        const searchQuery = document.getElementById('searchInput').value;

        // Send an AJAX request to fetch filtered patient data
        $.ajax({
            url: "{{ route('Lab.patient_list.search') }}", // Use the same route for both pages
            type: "GET",
            data: {
                query: searchQuery, // Pass the search query
                page: page,         // Pass the current page
            },
            success: function (response) {
                let tableBody = '';

                response.forEach(patient => {
                    if (page === "Patient_list") {
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
                    } else if (page === "Upload_reports") {
                        // Render table for Upload_reports
                        tableBody += `
                            <tr style="color: #3b0764; text-align:center;">
                                <td>${patient->Patient_Name}</td>
                                <td>${patient->Phone_Number}</td>
                                <td>${patient->Test_Name}</td>
                                <td>${patient->Appointment_Date}</td>
                                <td>
                                    <button onclick="openReportModal('${patient->Patient_Name }', '${patient->Patient_ID }', '${patient->Lab_ID }','${patient->Appointment_ID}')"
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
