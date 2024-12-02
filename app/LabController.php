<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
// use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
}
