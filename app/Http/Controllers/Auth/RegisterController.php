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

        try {
            // Start database transaction
            DB::beginTransaction();

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
            DB::commit();

            // Redirect to success page or return success response
            return redirect()->route('Lab.dashboard')->with('success', 'Registration successful!');
        } catch (\Exception $e) {
            // Rollback the transaction on error
//            DB::rollBack();

//            Redirect back with an error message
            return redirect()->back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);




             }
    }



}

