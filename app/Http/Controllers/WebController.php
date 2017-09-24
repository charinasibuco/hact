<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Mail;
use Validator;
use App\HIVInfo;

class WebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $email = old('email');
        $data  = compact('email');
        return view('web.main_layout', $data);

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
            
            ActivityLog::create([
                'page' => 'Login',
                'message' => 'Successfully login!',
                'user_id' => Auth::user()->id
            ]);

            return redirect()->route('home');
        }
        else
        {
            return redirect()->route('login_page')->with('error', 'Invalid Username and Password.');
        }
    }
    
    public function about()
    {
        $hiv_info = HIVInfo::where('display', 1)->orderBy('type','asc')->get();
        $data = compact('hiv_info');
        $data["email"] = old('email');
        return view('web.about_layout', $data);
    }
    public function hiv_test()
    {
        $data["email"] = old('email');
        return view('web.hiv_test_layout',$data);
    }

    public function submit_form(Request $request)
    {
        $validator = Validator::make(
                        $request->all(), [
                            'full_name' => 'required',
                            'email'     => 'required|email',
                            'message'   => 'required'
                        ], [
                            'full_name.required'    => 'Full Name is required.',
                            'email.required'        => 'Email is required.',
                            'email.email'           => 'Email is not a valid email address.',
                            'message.required'      => 'Message is required'
                        ]
                    );

        if($validator->fails())
        {
            return redirect('/#contact-form')->withErrors($validator)->withInput();
        }

        // No errors
        $name   = $request->full_name;
        $email  = $request->email;
        $msg    = $request->message;

        $data = compact('name', 'email', 'msg');

        $mail_send = Mail::send('hact.emails.contact_us', $data, function ($mail) use ($name, $email) {
            $mail->from( $email, $name );
            #$mail->to( 'info@hactbacolod.com', 'Hact Bacolod Admin' );
            $mail->to( 'john@hactbacolod.com', 'Hact Bacolod Admin' );
            $mail->subject( 'Contact Form' );
        });

        return redirect('/#contact-form')->with('status', 'Successully sent!');
    }
}
