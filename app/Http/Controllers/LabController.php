<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Facade\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LabController extends Controller
{
    //
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function dashboard()
    {
        return view('Lab.dashboard');
    }
    public function patient_list()
    {
        $id = 1;
        // Fetch data for a specific LabID
        $patients = DB::table('Appointments')
                ->join('Patient', 'Appointments.PatientID', '=', 'Patient.PatientID')
                ->join('Lab_Test', 'Appointments.TestID', '=', 'Lab_Test.TestID')
                ->select(
                    'Patient.Pt_Name as Patient_Name',
                    'Patient.Phone_no as Phone_Number',
                    'Appointments.Test_Status as Test_Status',
                    'Lab_Test.Test_name as Test_Name',
                    'Appointments.App_Date as Appointment_Date',
                    'Appointments.AppointmentID as Appointment_ID'
                )
                ->where('LabID', $id)
                ->get();

        return view('Lab.patient_list',['patients'=> $patients]);
    }

    public function markAsDone(Request $request)
    {

         // Validate the incoming request
        $request->validate([
            'appointmentId' => 'required|integer', // Ensure it’s a valid integer
        ]);

        $id = $request->appointmentId;

        // Update the Test_Status directly in the database
        $updated = DB::table('Appointments')
            ->where('AppointmentID', $id)
            ->update(['Test_Status' => 'Done']);

        if ($updated) {
            return response()->json(['success' => true, 'message' => 'Status updated successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Failed to update status or no changes made'], 400);

        // \Log::info('Incoming Request Data:', $request->all());

        // dd($request->all());
        // $validatedData = $request->validate([
        //     'appointmentId' => 'required|integer|exists:appointments,id', // Ensure the ID exists in your table
        //     'status' => 'required|string',
        // ]);

        // Update Report_Status in Appointments table
        // DB::table('Appointments')
        //     ->where('AppointmentID', $id)
        //     ->update(['Test_Status' => 'Done']);

        // return response()->json(['success' => true]);
    }

    public function upload_reports_view()
    {
        $id = 1;
        // Fetch data for a specific LabID
        $patients = DB::table('Appointments')
                ->join('Patient', 'Appointments.PatientID', '=', 'Patient.PatientID')
                ->join('Lab_Test', 'Appointments.TestID', '=', 'Lab_Test.TestID')
                ->select(
                    'Patient.Pt_Name as Patient_Name',
                    'Patient.Phone_no as Phone_Number',
                    'Lab_Test.Test_name as Test_Name',
                    'Appointments.App_Date as Appointment_Date',
                    'Appointments.AppointmentID as Appointment_ID',
                    'Appointments.LabID as Lab_ID',
                    'Patient.PatientID as Patient_ID'
                )
                ->where('LabID', $id)
                ->where('Appointments.Test_Status', 'Done')
                ->where('Appointments.Report_Status', 'Not Uploaded')
                ->get();

        return view('Lab.upload_reports',['patients'=> $patients]);
    }


    public function uploadReport(Request $request)
    {
        $request->validate([
            'report' => 'required|file|mimes:png,jpg,pdf|max:10240', // Restrict file type and size
        ]);

        $patientId = $request->input('patient_id');
        $labId = $request->input('lab_id');
        $appointmentId = $request->input('appointment_id');

        // Generate the file name
        $fileName = "{$appointmentId}_{$patientId}_{$labId}." . $request->file('report')->getClientOriginalExtension();

        // Save file to storage/app/Report
        $request->file('report')->storeAs('Report', $fileName);

        // Insert into Report table
        DB::table('Report')->insert([
            'File' => "{$appointmentId}_{$patientId}_{$labId}",
            'Report_status' => 'Not Sent',
            'PatientID' => $patientId,
            'LabID' => $labId,
        ]);

        // Update Report_Status in Appointments table
        DB::table('Appointments')
            ->where('AppointmentID', $appointmentId)
            ->update(['Report_Status' => 'Uploaded']);

        return back()->with('success', 'Report uploaded successfully!');
    }

    public function upload_bills_view()
    {
        $id = 1;
        // Fetch data for a specific LabID
        $patients = DB::table('Appointments')
                ->join('Patient', 'Appointments.PatientID', '=', 'Patient.PatientID')
                ->join('Lab_Test', 'Appointments.TestID', '=', 'Lab_Test.TestID')
                ->select(
                    'Patient.Pt_Name as Patient_Name',
                    'Patient.Phone_no as Phone_Number',
                    'Lab_Test.Test_name as Test_Name',
                    'Appointments.App_Date as Appointment_Date',
                    'Appointments.AppointmentID as Appointment_ID',
                    'Appointments.LabID as Lab_ID',
                    'Patient.PatientID as Patient_ID'
                )
                ->where('LabID', $id)
                ->where('Appointments.Test_Status', 'Done')
                ->where('Appointments.Bill_Status', 'Not Uploaded')
                ->get();

        return view('Lab.upload_bills',['patients'=> $patients]);
    }


    public function uploadBill(Request $request)
    {
        $request->validate([
            'bill' => 'required|file|mimes:png,jpg,pdf|max:10240', // Restrict file type and size
        ]);

        $patientId = $request->input('patient_id');
        $labId = $request->input('lab_id');
        $appointmentId = $request->input('appointment_id');

        // Generate the file name
        $fileName = "{$appointmentId}_{$patientId}_{$labId}." . $request->file('bill')->getClientOriginalExtension();

        // Save file to storage/app/Bill
        $request->file('bill')->storeAs('Bill', $fileName);

        // Insert into bill table
        DB::table('Bill')->insert([
            'File' => "{$appointmentId}_{$patientId}_{$labId}",
            'Bill_status' => 'Not Sent',
            'PatientID' => $patientId,
            'LabID' => $labId,
        ]);

        // Update Bill_Status in Appointments table
        DB::table('Appointments')
            ->where('AppointmentID', $appointmentId)
            ->update(['Bill_Status' => 'Uploaded']);

        return back()->with('success', 'Bill uploaded successfully!');
    }
}
