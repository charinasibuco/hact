<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Hact\Log\ActivityLogRepository as ActivityLog;
use Hact\CheckupReferrals\ReferralsRepository as Referrals;


class ReferralsController extends Controller
{
    public function __construct(ActivityLog $log, Referrals $referrals)
    {
        $this->referrals  = $referrals;
        if(Auth::user()->access != 1 )
        {
            abort(403);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $data = $this->referrals->getReferrals($request);
        return view('hact.referrals.index', $data);
        #dd($patient_sort);
           
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function complete($id, $referral, $source, Request $request)
    {
        $this->referrals->complete($id, $referral, $request);

        if($source==1)
        {
        return redirect()->route('referrals')->with('status', 'Referral successfully declared complete');
        }
        else
        {
        return redirect()->route('home')->with('status', 'Referral successfully declared complete');
        }
    }

     public function incomplete($id, $referral, $source,Request $request)
    {
        $this->referrals->incomplete($id, $referral, $request);

        if($source==1)
        {
        return redirect()->route('referrals')->with('status', 'Referral successfully declared incomplete');
        }
        else
        {
        return redirect()->route('home')->with('status', 'Referral successfully declared incomplete');
        }
        
    }
}
