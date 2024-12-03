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
                            <form  method="POST" action="{{ route('labRegister.submit') }}" id="labRegister_form">
                                @csrf
                                <div class="row">
                                    <!-- Left Column -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="labName" class="form-label">Lab Name</label>
                                            <input type="text" class="form-control" id="labName" name="labName" required>
                                            <div id="labNameError" class="text-danger"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="labEmail" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="labEmail" name="labEmail" required>
                                            <div id="labEmailError" class="text-danger"></div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="labPhone" class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" id="labPhone"  name="labPhone" required>
                                            <div id="labPhoneError" class="text-danger"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="labAddress" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="labAddress" name="labAddress" required>
                                            <div id="labAddressError" class="text-danger"></div>
                                        </div>
                                    </div>

                                    <!-- Right Column -->
                                    <div class="col-md-6">

                                        <div class="mb-3">
                                            <label for="labLicenseNumber" class="form-label">License Number</label>
                                            <input type="text" class="form-control" id="labLicenseNumber" name="labLicenseNumber" required>
                                            <div id="labLicenseNumberError" class="text-danger"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="labloginID" class="form-label">Login ID</label>
                                            <input type="text" class="form-control" id="labloginID" name="labloginID" required>
                                            <div id="labloginIDError" class="text-danger"></div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="labPassword" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="labPassword"  name="labPassword" required>
                                            <div id="labPasswordError" class="text-danger"></div>
                                        </div>


                                        <div class="mb-3">
                                            <label class="form-label">Types of Tests Offered</label>

                                            <div class="dropdown">
                                                <button class="btn custom-btn-drop dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Select Tests
                                                </button>
                                                <ul class="dropdown-menu custom-dropdown-menu keep-open" aria-labelledby="dropdownMenuButton" style="padding: 10px; width: 100%;">
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="COVID-19 testing"> COVID-19 testing
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="Routine Blood Tests"> Routine Blood Tests
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="STD Testing"> STD Testing
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="TB Test"> TB Test
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="Chest X-Ray"> Chest X-Ray
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="Breath Alcohol Test"> Breath Alcohol Test
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="Comprehensive Metabolic Panel"> Comprehensive Metabolic Panel
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="A1C Blood Testing"> A1C Blood Testing
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="Urinalysis"> Urinalysis
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="Complete blood count (CBC)"> Complete blood count (CBC)
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="Hemoglobin A1c (HbA1c)"> Hemoglobin A1c (HbA1c)
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="Prothrombin time"> Prothrombin time
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="Thyroid-stimulating hormone (TSH)"> Thyroid-stimulating hormone (TSH)
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="Bacterial culture"> Bacterial culture
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="Allergy Blood Test"> Allergy Blood Test
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="Beta HCG Test"> Beta HCG Test
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="Pregnancy Test"> Pregnancy Test
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="Cardiac CT scan"> Cardiac CT scan
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="MRI"> MRI
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="tests[]" value="Cardiac Catheterization"> Cardiac Catheterization
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
{{--                                <div class="mb-3">--}}
{{--                                    <div class="form-check">--}}
{{--                                        <input type="checkbox" class="form-check-input" id="labTermsCheck">--}}
{{--                                        <label class="form-check-label" for="labTermsCheck" onclick="showTermsModal()">I agree to the terms and conditions</label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="insuranceTermsCheck" name="insuranceTermsCheck" required>
                                        <label class="form-check-label" for="insuranceTermsCheck" onclick="showTermsModal()">
                                            I agree to the terms and conditions</label>
                                    </div>
                                    <div id="insuranceTermsCheckError" class="text-danger"></div>
                                </div>

{{--                                <button type="submit" class="btn btn-primary w-100">Register as Lab</button>--}}
                                <button type="submit" class="btn custom-btn w-50">{{ __('Register') }}</button>

                            </form>
                        </div>

                        <!-- Insurance Company Form -->
                        <div id="insurance-form" class="form-content hidden">
                        <form method="POST" action="{{ route('insuranceRegister.submit') }}" id="insuranceRegister_form">
                                @csrf

                                <!-- Company Name Field -->
                                <div class="mb-3">
                                    <label for="insuranceCompany" class="form-label">Company Name</label>
                                    <input type="text" class="form-control" id="insuranceCompany" name="insuranceCompany" placeholder="Enter your company name" required>
                                    <div id="insuranceCompanyError" class="text-danger"></div>
                                </div>

                                <!-- Email Field -->
                                <div class="mb-3">
                                    <label for="insuranceEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="insuranceEmail" name="insuranceEmail" placeholder="Enter your email" required>
                                    <div id="insuranceEmailError" class="text-danger"></div>
                                </div>

                                <!-- Login ID Field -->
                                <div class="mb-3">
                                    <label for="InsuranceloginID" class="form-label">Login ID</label>
                                    <input type="text" class="form-control" id="InsuranceloginID" name="InsuranceloginID" placeholder="Enter your login ID" required>
                                    <div id="InsuranceloginIDError" class="text-danger"></div>
                                </div>

                                <!-- Password Field -->
                                <div class="mb-3">
                                    <label for="insurancePassword" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="insurancePassword" name="insurancePassword" placeholder="Enter your password" required>
                                    <div id="insurancePasswordError" class="text-danger"></div>
                                </div>

{{--                                <!-- Terms Checkbox -->--}}
{{--                                <div class="mb-3">--}}
{{--                                    <div class="form-check">--}}
{{--                                        <input type="checkbox" class="form-check-input" id="insuranceTermsCheck" name="insuranceTermsCheck" required>--}}
{{--                                        <label class="form-check-label" for="insuranceTermsCheck">--}}
{{--                                            I agree to the <a href="#">terms and conditions</a>--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                    <div id="insuranceTermsCheckError" class="text-danger"></div>--}}
{{--                                </div>--}}

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="insuranceTermsCheck" name="insuranceTermsCheck" required>
                                        <label class="form-check-label" for="insuranceTermsCheck" onclick="showTermsModal()">
                                            I agree to the terms and conditions</label>
                                    </div>
                                    <div id="insuranceTermsCheckError" class="text-danger"></div>
                                </div>

                                <!-- Submit Button -->
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


<script>
    document.addEventListener("DOMContentLoaded", () => {
        const form = document.getElementById("insuranceRegister_form");
        const insuranceCompany = document.getElementById("insuranceCompany");
        const insuranceEmail = document.getElementById("insuranceEmail");
        const InsuranceloginID = document.getElementById("InsuranceloginID");
        const insurancePassword = document.getElementById("insurancePassword");
        const insuranceTermsCheck = document.getElementById("insuranceTermsCheck");

        // Fetch already taken Login IDs from Laravel backend
        const takenLoginIDs = @json(\DB::table('credentials')->pluck('Login_ID')->toArray());

        form.addEventListener("submit", (event) => {
            let isValid = true;

            // Clear previous error messages
            clearErrors();

            // Validate Login ID
            if (!InsuranceloginID.value.trim()) {
                isValid = false;
                showError("InsuranceloginIDError", "The login ID is required.");
            } else if (InsuranceloginID.value.length > 255) {
                isValid = false;
                showError("InsuranceloginIDError", "The login ID may not exceed 255 characters.");
            } else if (takenLoginIDs.includes(InsuranceloginID.value.trim())) {
                isValid = false;
                showError("InsuranceloginIDError", "The login ID has already been taken.");
            }

            // Validate Password
            if (!insurancePassword.value.trim()) {
                isValid = false;
                showError("insurancePasswordError", "The password field is required.");
            } else if (insurancePassword.value.length < 8) {
                isValid = false;
                showError("insurancePasswordError", "The password must be at least 8 characters.");
            }

            // Validate Company Name
            if (!insuranceCompany.value.trim()) {
                isValid = false;
                showError("insuranceCompanyError", "The company name is required.");
            } else if (insuranceCompany.value.length > 255) {
                isValid = false;
                showError("insuranceCompanyError", "The company name may not exceed 255 characters.");
            }

            // Validate Email
            if (!insuranceEmail.value.trim()) {
                isValid = false;
                showError("insuranceEmailError", "The email address is required.");
            } else if (!validateEmail(insuranceEmail.value)) {
                isValid = false;
                showError("insuranceEmailError", "The email address must be valid.");
            } else if (insuranceEmail.value.length > 255) {
                isValid = false;
                showError("insuranceEmailError", "The email address may not exceed 255 characters.");
            }

            // Validate Terms Check
            if (!insuranceTermsCheck.checked) {
                isValid = false;
                showError("insuranceTermsCheckError", "You must agree to the terms and conditions.");
            }

            // Prevent form submission if validation fails
            if (!isValid) {
                event.preventDefault();
            }
        });

        // Helper function to display errors
        function showError(elementId, message) {
            document.getElementById(elementId).innerText = message;
        }

        // Helper function to clear all errors
        function clearErrors() {
            document.querySelectorAll(".text-danger").forEach((el) => {
                el.innerText = "";
            });
        }

        // Email validation function
        function validateEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const form = document.getElementById("labRegister_form");
        const labName = document.getElementById("labName");
        const labEmail = document.getElementById("labEmail");
        const labPhone = document.getElementById("labPhone");
        const labAddress = document.getElementById("labAddress");
        const labLicenseNumber = document.getElementById("labLicenseNumber");
        const labloginID = document.getElementById("labloginID");
        const labPassword = document.getElementById("labPassword");
        const testCheckboxes = document.querySelectorAll('input[name="tests[]"]');
        const dropdownContainer = document.querySelector(".dropdown");

        // Fetch already taken Login IDs and Emails from Laravel backend
        const takenLoginIDs = @json(\DB::table('credentials')->pluck('Login_ID')->toArray());
        const takenEmails = @json(\DB::table('lab')->pluck('Email')->toArray());
        const takeLiceseNumbers = @json(\DB::table('lab')->pluck('License_no')->toArray());

        form.addEventListener("submit", (event) => {
            let isValid = true;

            // Clear previous error messages
            clearErrors();

            // Validate Lab Name
            if (!labName.value.trim()) {
                isValid = false;
                showError("labNameError", "The lab name is required.");
            } else if (labName.value.length > 255) {
                isValid = false;
                showError("labNameError", "The lab name may not exceed 255 characters.");
            }

            // Validate Email
            if (!labEmail.value.trim()) {
                isValid = false;
                showError("labEmailError", "The email address is required.");
            } else if (!validateEmail(labEmail.value)) {
                isValid = false;
                showError("labEmailError", "The email address must be valid.");
            } else if (labEmail.value.length > 50) {
                isValid = false;
                showError("labEmailError", "The email address may not exceed 50 characters.");
            } else if (takenEmails.includes(labEmail.value.trim())) {
                isValid = false;
                showError("labEmailError", "The email address has already been taken.");
            }

            // Validate Phone Number
            if (!labPhone.value.trim()) {
                isValid = false;
                showError("labPhoneError", "The phone number is required.");
            } else if (!/^\d{10}$/.test(labPhone.value)) {
                isValid = false;
                showError("labPhoneError", "The phone number must be exactly 10 digits.");
            }

            // Validate Address
            if (!labAddress.value.trim()) {
                isValid = false;
                showError("labAddressError", "The address is required.");
            } else if (labAddress.value.length > 255) {
                isValid = false;
                showError("labAddressError", "The address may not exceed 255 characters.");
            }

            // Validate License Number
            if (!labLicenseNumber.value.trim()) {
                isValid = false;
                showError("labLicenseNumberError", "The license number is required.");
            } else if (labLicenseNumber.value.length > 100) {
                isValid = false;
                showError("labLicenseNumberError", "The license number may not exceed 100 characters.");
            } else if (takeLiceseNumbers.includes(labLicenseNumber.value.trim())) {
                isValid = false;
                showError("labLicenseNumberError", "The license number has already been taken.");
            }

            // Validate Login ID
            if (!labloginID.value.trim()) {
                isValid = false;
                showError("labloginIDError", "The login ID is required.");
            } else if (labloginID.value.length > 255) {
                isValid = false;
                showError("labloginIDError", "The login ID may not exceed 255 characters.");
            } else if (takenLoginIDs.includes(labloginID.value.trim())) {
                isValid = false;
                showError("labloginIDError", "The login ID has already been taken.");
            }

            // Validate Password
            if (!labPassword.value.trim()) {
                isValid = false;
                showError("labPasswordError", "The password field is required.");
            } else if (labPassword.value.length < 8) {
                isValid = false;
                showError("labPasswordError", "The password must be at least 8 characters.");
            }

            // Validate Test Selection
            const isTestSelected = Array.from(testCheckboxes).some((checkbox) => checkbox.checked);
            if (!isTestSelected) {
                isValid = false;
                const errorMessage = document.createElement("div");
                errorMessage.className = "text-danger";
                errorMessage.id = "testCheckboxError";
                errorMessage.innerText = "Please select at least one test.";
                dropdownContainer.appendChild(errorMessage);
            }

            // Prevent form submission if validation fails
            if (!isValid) {
                event.preventDefault();
            }
        });

        // Helper function to display errors
        function showError(elementId, message) {
            document.getElementById(elementId).innerText = message;
        }

        // Helper function to clear all errors
        function clearErrors() {
            document.querySelectorAll(".text-danger").forEach((el) => {
                el.innerText = "";
            });
            const testError = document.getElementById("testCheckboxError");
            if (testError) testError.remove();
        }

        // Email validation function
        function validateEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }
    });
</script>


<script>
    const form = document.getElementById('labRegister_form');
    const testCheckboxes = document.querySelectorAll('input[name="tests[]"]');
    const selectedTestsField = document.getElementById('selected_tests');

    form.addEventListener('submit', (event) => {
        // Gather selected test IDs
        const selectedTests = Array.from(testCheckboxes)
            .filter((checkbox) => checkbox.checked)
            .map((checkbox) => checkbox.value);

        // Populate the hidden input field with the selected test IDs
        selectedTestsField.value = JSON.stringify(selectedTests);
    });
</script>


</body>
</html>
