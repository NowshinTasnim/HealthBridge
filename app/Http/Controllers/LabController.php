<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Facade\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class LabController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function dashboard()
    {
        // Retrieve LabID from session
        $labId = Session::get('lab_id');
        $log = Session::get('Login_ID');
        if (!$labId) {
            return redirect()->route('login')->with('error', 'Session expired. Please log in again.');
        }

        // Retrieve additional lab details if needed
        $lab = DB::table('Lab')
        ->where('LabID', $labId)
        ->first();

        return view('Lab.dashboard',['lab' => $lab,'log' =>$log]);
    }
    public function profile()
    {
        $id = Session::get('lab_id');
        $log = Session::get('Login_ID');

        if (!$id) {
            return redirect()->route('login')->with('error', 'Session expired. Please log in again.');
        };

        $lab = DB::table('Lab')
            ->where('LabID', $id)
            ->first();

        // Fetch tests available for the lab
        $availableTests = DB::table ('Test_availability')
            ->join('Lab_Test', 'Test_availability.TestID', '=', 'Lab_Test.TestID')
            ->select('Lab_Test.TestID as TestID',
            'Lab_Test.Test_name as Test_name')
            ->where('LabID', $id)
            ->distinct()
            ->get();

        // Fetch all possible tests
        $excludedTestIds = DB::table('Test_availability')
            ->join('Lab_Test', 'Test_availability.TestID', '=', 'Lab_Test.TestID')
            ->select('Lab_Test.TestID')
            ->where('LabID', $id)
            ->distinct();

        $addTests = DB::table('Lab_Test')
            ->whereNotIn('TestID', $excludedTestIds)
            ->get();

        return view('Lab.profile', [
            'lab' => $lab,
            'availableTests' => $availableTests,
            'allTests' => $addTests,
            'log' => $log,
        ]);
    }

    public function updateTest(Request $request)
    {
        $request->validate([
            'LabID' => 'required|integer|exists:Lab,LabID',
        ]);
        $log = Session::get('Login_ID');

        $action = $request->Action;
        $labId = $request->LabID;
        if($action == "Add")
        {
            // get available date ids after december 5 2024
            $availableDateIds = DB::table("available_dates")
            ->where("Available_date", '>','2024-12-05')
            ->pluck('AvailableID')
            ->toArray();

            //insert test to database for each available id
            $testIds = $request->TestID;
            foreach($testIds as $testId){
                foreach($availableDateIds as $availableDateId)
                //for($i=13; $i<21;$i++)
                {
                DB::table("Test_availability")->insert([
                    'LabID' => $labId,
                    'TestID' => $testId,
                    'AvailableID' => $availableDateId,
                ]);
                }
            }

            return redirect()->route('Lab.profile')->with('success', 'Test added successfully.');
        }
        else if($action == "Delete"){
            $testId = $request->TestID;
            //Delete all the rows
            DB::table("Test_availability")
                ->where('LabID' , $labId)
                ->where('TestID' , $testId)
                ->delete();
                return redirect()->route('Lab.profile')->with('success', 'Test deleted successfully.');
        }
        return redirect()->route('Lab.profile')->with('error', 'Invalid action specified.');
    }

    public function patient_list()
    {
        $id = Session::get('lab_id');
        $log = Session::get('Login_ID');
        if (!$id) {
            return redirect()->route('login')->with('error', 'Session expired. Please log in again.');
        };
        // Fetch data for a specific LabID
        // $patients = DB::table('Appointments')
        //         ->join('Patient', 'Appointments.PatientID', '=', 'Patient.PatientID')
        //         ->join('Lab_Test', 'Appointments.TestID', '=', 'Lab_Test.TestID')
        //         ->select(
        //             'Patient.Pt_Name as Patient_Name',
        //             'Patient.Phone_no as Phone_Number',
        //             'Appointments.Test_Status as Test_Status',
        //             'Lab_Test.Test_name as Test_Name',
        //             'Appointments.App_Date as Appointment_Date',
        //             'Appointments.AppointmentID as Appointment_ID'
        //         )
        //         ->where('LabID', $id)
        //         ->get();

        // Call the stored procedure
        $patients = collect(DB::select('CALL GetPatientDetails(?, ?, ?)', [
            $id,
            NULL,
            TRUE
        ]));


        return view('Lab.patient_list',['patients'=> $patients, 'log' => $log]);
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
        $id = Session::get('lab_id');
        $log = Session::get('Login_ID');

        if (!$id) {
            return redirect()->route('login')->with('error', 'Session expired. Please log in again.');
        };
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

        return view('Lab.upload_reports',['patients'=> $patients, 'log' => $log]);
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
        $id = Session::get('lab_id');
        $log = Session::get('Login_ID');

        if (!$id) {
            return redirect()->route('login')->with('error', 'Session expired. Please log in again.');
        };
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

        return view('Lab.upload_bills',['patients'=> $patients, 'log' => $log]);
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
    public function searchPatients(Request $request)
    {
        $query = $request->input('query');
        $page = $request->input('page');
        $id = Session::get('lab_id');

        if (!$id) {
            return redirect()->route('login')->with('error', 'Session expired. Please log in again.');
        };
        // Fetch patients whose names match the search query
        if($page == "Patient_list")
        {
            $patients = collect(DB::select('CALL GetPatientDetails(?, ?, ?)', [
                $id,
                $query,
                TRUE
            ]));
            // $patients = DB::table('Appointments')
            //     ->join('Patient', 'Appointments.PatientID', '=', 'Patient.PatientID')
            //     ->join('Lab_Test', 'Appointments.TestID', '=', 'Lab_Test.TestID')
            //     ->select(
            //         'Patient.Pt_Name as Patient_Name',
            //         'Patient.Phone_no as Phone_Number',
            //         'Appointments.Test_Status as Test_Status',
            //         'Lab_Test.Test_name as Test_Name',
            //         'Appointments.App_Date as Appointment_Date',
            //         'Appointments.AppointmentID as Appointment_ID'
            //     )
            //     ->where('Patient.Pt_Name', 'like', '%' . $query . '%')
            //     ->where('LabID', $id)
            //     ->get();
        }
        else if($page == "Upload_reports")
        {
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
                ->where('Patient.Pt_Name', 'like', '%' . $query . '%')
                ->where('Appointments.Test_Status', 'Done')
                ->where('Appointments.Report_Status', 'Not Uploaded')
                ->get();
        }
        else if ($page == "Upload_bills")
        {
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
                ->where('Patient.Pt_Name', 'like', '%' . $query . '%')
                ->where('Appointments.Test_Status', 'Done')
                ->where('Appointments.Bill_Status', 'Not Uploaded')
                ->get();
        }

        return response()->json($patients);
    }

}
