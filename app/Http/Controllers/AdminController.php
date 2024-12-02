<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function requestClaim()
    {
        return view('admin.request-claim');
    }

    public function approvedClaims()
    {
        return view('admin.approved-claims');
    }

    public function rejectedClaims()
    {
        return view('admin.rejected-claims');
    }
}
