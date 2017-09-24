<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hact\Log\ActivityLogRepository as ActivityLog;
use Auth;

class AuthCustomController extends Controller
{   
    private $log;

    public function __construct(ActivityLog $log)
    {
       $this->log = $log;
    }

    public function index()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $email      = trim($request->email);
        $password   = trim($request->password);

        if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1]))
        {
            if(Auth::user()->reset == 1)
            {
                return redirect()->route('user_password_edit');
            }
            
             $this->log->store([
                'page' => 'Login',
                'message' => 'Successfully login!',
                'user_id' => Auth::user()->id
            ],$request);

            return redirect()->route('home');
        }
        else
        {
            return redirect()->route('login_page')->with('error', 'Invalid Username and Password.');
        }
    }

    public function logout()
    {
         $this->log->create([
            'page' => 'Logout',
            'message' => 'Successfully logout!',
            'user_id' => Auth::user()->id
        ]);

        Auth::logout();
        
        return redirect()->route('login_page');
    }
}
