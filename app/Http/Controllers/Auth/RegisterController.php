<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('auth.register');
    }

    public function register_insurance(Request $request): \Illuminate\Http\RedirectResponse
    {

//        dd($request->all());
        // Validate the request
        $request->validate([
            'InsuranceloginID' => 'required|string|unique:credentials,Login_ID', // Ensure Login_ID is unique
            'insurancePassword' => 'required|string|min:8', // Password validation
            'insuranceCompany' => 'required|string|max:255', // Required for Insurance Company
            'insuranceEmail' => 'required|email|max:255', // Required for Insurance Company
        ], [
            // Custom messages
            'InsuranceloginID.required' => 'The login ID is required.',
            'InsuranceloginID.unique' => 'The login ID has already been taken.',
            'insurancePassword.required' => 'The password field is required.',
            'insurancePassword.min' => 'The password must be at least 8 characters.',
            'insuranceCompany.required' => 'The company name is required.',
            'insuranceCompany.max' => 'The company name may not exceed 255 characters.',
            'insuranceEmail.required' => 'The email address is required.',
            'insuranceEmail.email' => 'The email address must be valid.',
            'insuranceEmail.max' => 'The email address may not exceed 255 characters.',
        ]);

        //dd($request->all());
//
//        try {
//            //dd($request->all());
//            // Start database transaction
//            DB::beginTransaction();

            $hashedPassword = Hash::make($request->input('insurancePassword'));

            // Step 1: Insert into `credentials` table
            $credentialId = DB::table('credentials')->insertGetId([
                'Login_ID' => $request->input('InsuranceloginID'),
                'Log_Password' => $hashedPassword, // Hash the password
                'User_type' => 1,
            ]);


            // Step 2: Insert into `insurance_company` table
            DB::table('insurance_company')->insert([
                'Ins_Name' => $request->input('insuranceCompany'),
                'Email' => $request->input('insuranceEmail'),
                'CredentialID' => $credentialId,
            ]);

//            Commit the transaction
           // DB::commit();

            // Redirect to success page or return success response
            return redirect()->route('admin.dashboard')->with('success', 'Registration successful!');
//        } catch (\Exception $e) {
            // Rollback the transaction on error
//            DB::rollBack();

//            Redirect back with an error message
            //return redirect()->back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);

    }
    public function register_lab(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Validate the request
        $request->validate([
            'labloginID' => 'required|string|unique:credentials,Login_ID',
            'labPassword' => 'required|string|min:8',
            'labName' => 'required|string|max:255|unique:lab,Lab_Name',
            'labAddress' => 'required|string|max:255',
            'labLicenseNumber' => 'required|string|max:100|unique:lab,License_no',
            'labPhone' => 'required|string|size:10|regex:/^[0-9]+$/',
            'labEmail' => 'required|email|max:50|unique:lab,Email',
            'tests' => 'required|array|min:1', // Ensure at least one test name is selected
            'tests.*' => 'string', // Validate that each test is a string
        ], [
            'labloginID.required' => 'The login ID is required.',
            'labloginID.unique' => 'The login ID has already been taken.',
            'labPassword.required' => 'The password field is required.',
            'labPassword.min' => 'The password must be at least 8 characters.',
            'labName.required' => 'The lab name is required.',
            'labName.unique' => 'The lab name must be unique.',
            'labAddress.required' => 'The lab address is required.',
            'labLicenseNumber.required' => 'The license number is required.',
            'labLicenseNumber.unique' => 'The license number must be unique.',
            'labPhone.required' => 'The phone number is required.',
            'labPhone.size' => 'The phone number must be exactly 10 digits.',
            'labPhone.regex' => 'The phone number must contain only digits.',
            'labEmail.required' => 'The email address is required.',
            'labEmail.email' => 'The email address must be valid.',
            'labEmail.unique' => 'The email address must be unique.',
            'tests.required' => 'Please select at least one test.',
            'tests.*.string' => 'Each test must be a valid string.',
        ]);

        try {
            // Start a database transaction
            DB::beginTransaction();

            // Hash the password
            $hashedPassword = Hash::make($request->input('labPassword'));

            // Step 1: Insert into `credentials` table
            $credentialId = DB::table('credentials')->insertGetId([
                'Login_ID' => $request->input('labloginID'),
                'Log_Password' => $hashedPassword,
                'User_type' => 2, // Assuming `2` for Lab
            ]);

            // Step 2: Insert into `lab` table
            $labId = DB::table('lab')->insertGetId([
                'Lab_Name' => $request->input('labName'),
                'Physical_address' => $request->input('labAddress'),
                'License_no' => $request->input('labLicenseNumber'),
                'Phone_no' => $request->input('labPhone'),
                'Email' => $request->input('labEmail'),
                'CredentialID' => $credentialId,
            ]);


            // Step 3: Get available dates later than December 5, 2024
            $availableDates = DB::table('available_dates')
                ->where('Available_date', '>', '2024-12-05')
                ->pluck('AvailableID')
                ->toArray();

//            // Step 4: Fetch TestIDs from `lab_test` table
                 $testIds =  DB::table('lab_test')
                ->whereIn('Test_name', $selectedTestNames)
                ->pluck('TestID')
                ->toArray();


            // Step 5: Insert into `test_availability` table
            $testAvailabilityData = [];
            foreach ($testIds as $testId) {
                foreach ($availableDates as $availableId) {
                    $testAvailabilityData[] = [
                        'LabID' => $labId,
                        'TestID' => $testId,
                        'AvailableID' => $availableId,
                    ];
                }
            }

            // Insert the batch into `test_availability`
            DB::table('test_availability')->insert($testAvailabilityData);

            // Commit the transaction
            DB::commit();

            // Redirect to success page
            return redirect()->route('Lab.dashboard')->with('success', 'Lab registration successful!');
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();

            // Redirect back with an error message
            return redirect()->back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }



}

