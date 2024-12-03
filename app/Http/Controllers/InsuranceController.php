<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Facade\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InsuranceController extends Controller
{
    //
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function claim()
    {
        return view('Insurance.claim');
    }


    public function claim_list()
    {
        $insuranceId = 14;

        // Fetch claims and related data
        $claims = DB::table('claim')
            ->join('lab', 'claim.LabID', '=', 'lab.LabID') // Join claim with lab on LabID
            ->join('patient', 'claim.PatientID', '=', 'patient.PatientID') // Join claim with patient on PatientID
            ->leftJoin('appointments', function ($join) {
                $join->on('claim.PatientID', '=', 'appointments.PatientID')
                    ->on('claim.LabID', '=', 'appointments.LabID');
            }) // Join with appointments table
            ->select(
                'claim.ClaimID',
                'claim.PatientID', // Fetch PatientID
                'claim.LabID', // Fetch LabID
                'lab.Lab_Name', // Fetch Lab_Name from lab table
                'patient.Pt_Name', // Fetch Pt_Name from patient table
                'claim.File as Claim_File', // Claim file path
                'claim.Approval_status', // Approval status (Accepted/Rejected)
                'appointments.AppointmentID' // Fetch AppointmentID
            )
            ->where('claim.Filing_status', '=', 'Filled') // Filter by Filing_status = 'Filled'
            //->where('claim.InsuranceID', $insuranceId) // Filter by InsuranceID
            ->get();

        // Pass the claims data to the Blade view
        return view('Insurance.claim', compact('claims'));
    }
    public function updateApprovalStatus(Request $request)
    {
        //dd($request->action);
        $claimId = $request->input('ClaimID');
        $patientId = $request->input('PatientID');
        $labId = $request->input('LabID');
        $appointmentId = $request->input('AppointmentID');

        // Check if the action is "accept" or "reject"
        if ($request->action === 'accept') {
            // Update status to "Accepted"
            DB::table('claim')->where('ClaimID', $claimId)->update([
                'Approval_status' => 'Approved',
            ]);
            return redirect()->back()->with('success', 'Claim accepted successfully!');
        }

        if ($request->action === 'reject') {
            // Get the rejection reason from the request
            $reason = $request->input('Reason_for_rejection');

            // Update status to "Rejected" and store the reason
            DB::table('claim')->where('ClaimID', $claimId)->update([
                'Approval_status' => 'Reject',
                'Reason_for_rejection' => $reason,
            ]);

            return redirect()->back()->with('success', 'Claim rejected successfully.');
        }

        return redirect()->back()->with('error', 'Invalid action.');
    }

//    public function downloadFile(Request $request)
//    {
//        $request->validate([
//            'report' => 'required|file|mimes:png,jpg,pdf|max:10240', // Restrict file type and size
//        ]);
//
//        $patientId = $request->input('PatientID');
//        $labId = $request->input('LabID');
//        $appointmentId = $request->input('AppointmentID');
//
//        // Generate the file name
//        $fileName = "{$appointmentId}_{$patientId}_{$labId}.pdf" ;
//
//        $path = 'Claim/' . $fileName;
//
//        if(!Storage::exists($path)) {
//            return redirect()->back()->with('error', 'File not found.');
//        }
//        return response()->download(storage_path('app/' . $path), $fileName);
//
//
//    }

    public function downloadFile(Request $request)
    {
        $patientId = $request->input('PatientID');
        $labId = $request->input('LabID');
        $appointmentId = $request->input('AppointmentID');

        // Generate the file name
        $fileName = "{$appointmentId}_{$patientId}_{$labId}.pdf";

        // Path to the file in the 'storage/app/Claim' folder
        $path = "Claim/{$fileName}";

        // Check if the file exists in the storage
        if (!Storage::exists($path)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        // Use Storage to download the file
        return Storage::download($path, $fileName);
    }




//    public function acceptClaim($id)
//    {
//        DB::table('claim')->where('ClaimID', $id)->update([
//            'Approval_status' => 'Accepted',
//        ]);
//
//        return redirect()->back()->with('success', 'Claim accepted successfully!');
//    }
//
//    public function rejectClaim(Request $request, $id)
//    {
//        $filePath = $request->file('rejection_file')->store('rejection_reasons');
//
//        DB::table('claim')->where('ClaimID', $id)->update([
//            'Approval_status' => 'Rejected',
//            'Reason_for_rejection' => $filePath,
//        ]);
//
//        return redirect()->back()->with('success', 'Claim rejected successfully.');
//    }





//        // Fetch data for a specific LabID
//        $patients = DB::table('Appointments')
//            ->join('Patient', 'Appointments.PatientID', '=', 'Patient.PatientID')
//            ->join('Lab_Test', 'Appointments.TestID', '=', 'Lab_Test.TestID')
//            ->select(
//                'Patient.Pt_Name as Patient_Name',
//                'Patient.Phone_no as Phone_Number',
//                'Appointments.Test_Status as Test_Status',
//                'Lab_Test.Test_name as Test_Name',
//                'Appointments.App_Date as Appointment_Date',
//                'Appointments.AppointmentID as Appointment_ID'
//            )
//            ->where('LabID', $id)
//            ->get();
//
//        return view('Lab.patient_list',['patients'=> $patients]);
//    }
}
