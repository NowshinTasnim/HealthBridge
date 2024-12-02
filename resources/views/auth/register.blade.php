<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <img src="{{ asset('images/HealthBridgeLogo.png') }}" alt="Logo" class="logo">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .image-grid {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 50px;
        }
        .image-grid img {
            width: 150px;
            height: 150px;
            cursor: pointer;
            border-radius: 10px;
            transition: transform 0.3s;
        }
        .image-grid img:hover {
            transform: scale(1.1);
        }
        .image-grid p {
            text-align: center;
            margin-top: 10px;
        }
        .hidden {
            display: none;
        }

    </style>
</head>
<body>

<!-- Initial Page with Images -->
<div id="image-section">
    <div class="container">
        <h1 class="text-center mb-5">Register As</h1>
        <div class="image-grid">
            <div>
                <img src="{{ asset('images/Patients.png') }}" alt="Patient" onclick="showRegistrationPage('patient')">
                <p>Patient</p>
            </div>
            <div>
                <img src="{{ asset('images/Lab.png') }}" alt="Lab" onclick="showRegistrationPage('lab')">
                <p>Lab</p>
            </div>
            <div>
                <img src="{{ asset('images/Insurance.png') }}" alt="Insurance Company" onclick="showRegistrationPage('insurance')">
                <p>Insurance Company</p>
            </div>
        </div>
        <div class="text-center mt-3">
            <p class="custom-text">
                Already have an account? <a href="{{ route('login') }}" class="custom-signup-link">Login</a>
            </p>
        </div>
    </div>
</div>



<!-- Registration Form Section -->
<div id="registration-section" class="container2 hidden">
    <div class="container mt-5">
        <div class="row justify-content-center" style="height: auto; width: 100%">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <!-- Patient Form -->
                        <div id="patient-form" class="form-content hidden">
                            <form>
                                @csrf
                                <div class="row">
                                    <!-- Left Column -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="patientName" class="form-label">Full Name</label>
                                            <input type="text" class="form-control" id="patientName" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="patientEmail" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="patientEmail" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="patientPhone" class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" id="patientPhone" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="patientDOB" class="form-label">Date of Birth</label>
                                            <input type="date" class="form-control" id="patientDOB" required>
                                        </div>
                                    </div>

                                    <!-- Right Column -->
                                    <div class="col-md-6">

{{--                                        <div class="mb-3">--}}
{{--                                            <label for="insuranceProvider" class="form-label">Insurance Provider</label>--}}
{{--                                            <input type="text" class="form-control" id="insuranceProvider" required>--}}
{{--                                        </div>--}}
                                        <div class="mb-3">
                                            <label for="insuranceProvider" class="form-label">Insurance Provider</label>
                                            <select class="form-control custom-select-placeholder" id="insuranceProvider" name="insurance_provider" required>
                                                <option value="" class="placeholder">Select your Insurance Provider</option>
                                                <option value="ProviderA">AARP</option>
                                                <option value="ProviderB">American National Insurance Company</option>
                                                <option value="ProviderC">Bright Health</option>
                                                <option value="ProviderD">Cambia Health Solutions</option>

                                                <option value="ProviderE">CareSource</option>
                                                <option value="ProviderF">Elevance Health</option>
                                                <option value="ProviderG">Fallon Health</option>
                                                <option value="ProviderH">HealthNet</option>

                                                <option value="ProviderI">Highmark</option>
                                                <option value="ProviderJ"> Humana</option>
                                                <option value="ProviderK">Independence Blue Cross</option>
                                                <option value="ProviderL">Kaleida Health</option>

                                                <option value="ProviderM">MassHealth</option>
                                                <option value="ProviderN"> Molina Healthcare</option>
                                                <option value="ProviderO">Oscar Health</option>
                                                <option value="ProviderP">Shelter Insurance</option>

                                                <option value="ProviderQ">State Farm</option>
                                                <option value="ProviderR">UnitedHealth Group</option>
                                                <option value="ProviderS">Unitrin</option>
  T                                              <option value="ProviderT">WellCare</option>

                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="insuranceID" class="form-label">Insurance ID Number</label>
                                            <input type="text" class="form-control" id="insuranceID" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="ptloginID" class="form-label">Login ID</label>
                                            <input type="text" class="form-control" id="ptloginID" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="patientPassword" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="patientPassword" required>
                                        </div>
{{--                                        <div class="mb-3">--}}
{{--                                            <label for="confirmPassword" class="form-label">Confirm Password</label>--}}
{{--                                            <input type="password" class="form-control" id="confirmPassword" required>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="termsCheck">
                                        <label class="form-check-label" for="termsCheck" onclick="showTermsModal()">I agree to the terms and conditions</label>
                                    </div>
                                </div>
{{--                                <button type="submit" class="btn btn-primary w-50">Register</button>--}}
                                <button type="submit" class="btn custom-btn w-50">{{ __('Register') }}</button>
                            </form>
                        </div>

                        <!-- Lab Form -->
                        <div id="lab-form" class="form-content hidden">
                            <form>
                                @csrf
                                <div class="row">
                                    <!-- Left Column -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="labName" class="form-label">Lab Name</label>
                                            <input type="text" class="form-control" id="labName" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="labEmail" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="labEmail" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="labPhone" class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" id="labPhone" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="labAddress" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="labAddress" required>
                                        </div>
                                    </div>

                                    <!-- Right Column -->
                                    <div class="col-md-6">

                                        <div class="mb-3">
                                            <label for="licenseNumber" class="form-label">License Number</label>
                                            <input type="text" class="form-control" id="licenseNumber" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="labloginID" class="form-label">Login ID</label>
                                            <input type="text" class="form-control" id="labloginID" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="labPassword" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="labPassword" required>
                                        </div>

{{--                                        <div class="mb-3">--}}
{{--                                            <label for="confirmPassword" class="form-label">Confirm Password</label>--}}
{{--                                            <input type="password" class="form-control" id="confirmPassword" required>--}}
{{--                                        </div>--}}
{{--                                        <div class="mb-3">--}}
{{--                                            <label class="form-label">Types of Tests Offered</label><br>--}}
{{--                                            <input type="checkbox" id="test1"> Blood Test<br>--}}
{{--                                            <input type="checkbox" id="test2"> X-ray<br>--}}
{{--                                            <input type="checkbox" id="test3"> MRI Scan<br>--}}
{{--                                            <input type="checkbox" id="test3"> COVID Test<br>--}}
{{--                                        </div>--}}
{{--                                        <div class="row">--}}
{{--                                            <!-- Left Column -->--}}
{{--                                            <div class="col-md-6">--}}

{{--                                                <label class="form-label">Types of Tests Offered</label><br>--}}
{{--                                                <input type="checkbox" id="test1"> Blood Test<br>--}}
{{--                                                <input type="checkbox" id="test2"> X-ray<br>--}}
{{--                                                <input type="checkbox" id="test3"> MRI Scan<br>--}}
{{--                                                <input type="checkbox" id="test4"> COVID Test<br>--}}
{{--                                            </div>--}}

{{--                                            <!-- Right Column -->--}}
{{--                                            <div class="col-md-6">--}}
{{--                                                <label class="form-label">&nbsp;</label> <!-- Empty label for alignment --><br>--}}
{{--                                                <input type="checkbox" id="test5"> Urine Test<br>--}}
{{--                                                <input type="checkbox" id="test6"> ECG<br>--}}
{{--                                                <input type="checkbox" id="test7"> Ultrasound<br>--}}
{{--                                                <input type="checkbox" id="test8"> Allergy Test<br>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <div class="mb-3">
                                            <label class="form-label">Types of Tests Offered</label>

                                            <div class="dropdown">
                                                <button class="btn custom-btn-drop dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Select Tests
                                                </button>
                                                <ul class="dropdown-menu custom-dropdown-menu keep-open" aria-labelledby="dropdownMenuButton" style="padding: 10px; width: 100%;">
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="Blood Test"> Blood Test
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="X-ray"> X-ray
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="MRI Scan"> MRI Scan
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="COVID Test"> COVID Test
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="Urine Test"> Urine Test
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="ECG"> ECG
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="Ultrasound"> Ultrasound
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="Allergy Test"> Allergy Test
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="labTermsCheck">
                                        <label class="form-check-label" for="labTermsCheck" onclick="showTermsModal()">I agree to the terms and conditions</label>
                                    </div>
                                </div>
{{--                                <button type="submit" class="btn btn-primary w-100">Register as Lab</button>--}}
                                <button type="submit" class="btn custom-btn w-50">{{ __('Register') }}</button>

                            </form>
                        </div>

                        <!-- Insurance Company Form -->
                        <div id="insurance-form" class="form-content hidden">
                            <form method="POST" action="{{ route('insuranceRegister.submit') }}" >
                                @csrf
                                <div class="mb-3">
                                    <label for="insuranceCompany" class="form-label">Company Name</label>
                                    <input type="text" class="form-control" id="insuranceCompany" name="insuranceCompany" required>
                                    @error('insuranceCompany')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="insuranceEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="insuranceEmail" name="insuranceEmail" required>
                                    @error('insuranceEmail')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="InsuranceloginID" class="form-label">Login ID</label>
                                    <input type="text" class="form-control" id="InsuranceloginID" name="InsuranceloginID" required>
                                    @error('InsuranceloginID')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="insurancePassword" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="insurancePassword" name="insurancePassword" required>
                                    @error('insurancePassword')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="insuranceTermsCheck" onclick="showTermsModal()">
                                        <label class="form-check-label" for="insuranceTermsCheck">I agree to the terms and conditions</label>
                                    </div>
                                </div>
{{--                                <button type="submit" class="btn btn-primary w-100">Register Insurance Company</button>--}}
                                <button type="submit" class="btn custom-btn w-50">Register</button>

                            </form>
                        </div>


{{--                        <button class="btn btn-secondary w-100 mt-3" onclick="goBack()">Back to Selection</button>--}}
                        <button type="submit" class="btn custom-btn2 w-50" onclick="goBack()">{{ __('Back to Selection') }}</button>

                        <div class="text-center mt-3">
                            <p class="custom-text">
                                Already have an account? <a href="{{ route('login') }}" class="custom-signup-link">Login</a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Terms and Conditions Popup -->
<div id="termsPopup" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Terms and Conditions</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>1. Data Usage: Your data will only be used to facilitate services between patients, labs, and insurance companies and will not be shared with third parties without your explicit consent.</p>
                <p>2. Privacy Assurance: All personal and medical data is securely stored and protected in compliance with applicable regulations.</p>
                <p>
                    By registering, users acknowledge that they have read, understood, and agreed to these terms and conditions.
                    These terms may be updated periodically, and users will be notified of any significant changes.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn custom-btn2" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn custom-btn" data-bs-dismiss="modal">Accept</button>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function showRegistrationPage(type) {
        document.getElementById('image-section').classList.add('hidden');
        document.getElementById('registration-section').classList.remove('hidden');

        if (type === 'patient') {
            document.getElementById('patient-form').classList.remove('hidden');
            document.getElementById('lab-form').classList.add('hidden');
            document.getElementById('insurance-form').classList.add('hidden');
        } else if (type === 'lab') {
            document.getElementById('lab-form').classList.remove('hidden');
            document.getElementById('patient-form').classList.add('hidden');
            document.getElementById('insurance-form').classList.add('hidden');
        } else if (type === 'insurance') {
            document.getElementById('insurance-form').classList.remove('hidden');
            document.getElementById('patient-form').classList.add('hidden');
            document.getElementById('lab-form').classList.add('hidden');
        }
    }

    function goBack() {
        document.getElementById('image-section').classList.remove('hidden');
        document.getElementById('registration-section').classList.add('hidden');
    }

    function showTermsModal() {
        const modal = new bootstrap.Modal(document.getElementById('termsPopup'));
        modal.show();
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownMenu = document.querySelector('.dropdown-menu');

        // Prevent dropdown from closing when clicking inside the dropdown
        dropdownMenu.addEventListener('click', function (event) {
            event.stopPropagation();
        });
    });
</script>



</body>
</html>
