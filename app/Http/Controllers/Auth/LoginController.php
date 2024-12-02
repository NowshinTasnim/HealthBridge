<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function showLoginForm(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('auth.login');
    }

    /**
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        //Validate the form
        $this-> validate( $request, [
            'Login_ID' => 'required|string',
            'Log_Password' => 'required|min:8|max:12',
        ]);

        //Attempt to log the user in
        if(isset($_POST['Login_ID']) && isset ($_POST['Log_Password']))
        {
            $logid = $_POST['Login_ID'];
            $pass = $_POST['Log_Password'];

//            $sql = DB::select( "SELECT * FROM credentials WHERE (Login_ID = ? AND Log_Password = ?) LIMIT 1",[$logid,$pass]);
//Query builder prevents SQL injection
            $sql = DB::table('credentials')
                ->where('Login_ID', $logid)
                ->where('Log_Password', $pass)
                ->first();


            if($sql)
            {
                $logged = 'true';
                Session::put('Login_ID',$logid);
                Session::put('credential_id', $sql->CredentialID);
                Session::put('logged_in',$logged);

                switch ($sql->User_type) {
                    case 0:
                        return redirect()->route('admin.dashboard');
                    case 1:
                        return redirect()->route('patient.dashboard');
                    case 2:
                        return redirect()->route('Lab.dashboard');
                    case 3:
                        return redirect()->route('insurance.dashboard');
                    default:
                        // If user type is not recognized
                        return back()->with('error', 'Invalid user type');
                }


            }

        }
        return view('auth.login')->withInput($request->only('Login_ID'));

    }


    public function logout()
    {
        Session::flush();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
}
