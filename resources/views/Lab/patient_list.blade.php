@extends('layouts.lab')

@section('content')
<div class="container_start">
    <div class = "container">
        <!-- Total number -->
        <div class= "text-right" style="margin-right: 10px;">
            {{-- <h5> Total Number: 3</h5> --}}
            <h5> Total Number: {{$patients->count()}}</h5>
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
                    @foreach ($patients as $patient)
                        <tr style="color: #3b0764; text-align:center;">
                            <td>{{ $patient->Patient_Name }}</td>
                            <td>{{ $patient->Phone_Number }}</td>
                            <td>
                                @if ($patient->Test_Status == 'Done')
                                    <span class="text-green-500 font-bold">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Done
                                    </span>
                                @else
                                    <input type="checkbox" class="status-checkbox" value="{{ $patient->Appointment_ID }}" onclick="updateStatus('{{ $patient->Appointment_ID }}')">
                                @endif
                            </td>
                            <td>{{ $patient->Test_Name }}</td>
                            <td>{{ $patient->Appointment_Date }}</td>
                        </tr>
                    @endforeach
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
                url: "{{ route('Lab.patient_list.markAsDone') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
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


{{-- <script>
    function updateStatus(appointmentID) {
        // Log the appointment ID to check its value
        // console.log('Appointment ID:', appointmentID);

        // Confirm the action with the user
        if (confirm('Are you sure you want to mark this as "Done"?')) {
            // Make the fetch API call
            fetch('/lab/patient_list', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    appointmentID: appointmentID,
                    status: 'Done',
                }),

            })
            .then(response => {

                // console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error('Network response was not ok. Status: ${response.status}');
                }
                return response.json();
            })
            .then(data => {
                // console.log('Server Response:', data); // Log the server response for debugging
                if (data.success) {
                    alert('Status updated successfully.');
                    location.reload(); // Reload to reflect changes
                } else {
                    alert('Error: ${data.message || 'Something went wrong!'}');
                    this.checked = false; // Revert the checkbox
                }
            });
            .catch(error => {
                alert('An error occurred:' + error.message);
                console.error('Fetch Error:', error);
                this.checked = false; // Revert the checkbox
            });
        } else {
            console.log('Action cancelled by the user.');
            this.checked = false; // Revert the checkbox if user cancels
        }
    }


</script> --}}

@endsection
