<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Hact\Log\ActivityLogRepository as ActivityLog;
use Hact\CheckupLaboratoryRequest\LabRequestRepository as LabRequest;

class LabRequestController extends Controller
{
    public function __construct(ActivityLog $log, LabRequest $lab_request)
    {
        $this->lab_request  = $lab_request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $status = 'incomplete')
    {
        $data           = $this->lab_request->getLabRequests($request, $status);
        $data['status'] = $status;
        return view('hact.lab_requests.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function complete($id, $source,Request $request)
    {
        $this->lab_request->complete($id, $request);
        if($source==1)
        {
        return redirect()->route('lab_requests')->with('status', 'Lab Request successfully declared complete');
        }
        else
        {
        return redirect()->route('home')->with('status', 'Lab Request successfully declared complete');
        }
    }

     public function incomplete($id, $source,Request $request)
    {
        $this->lab_request->incomplete($id, $request);
        if($source==1)
        {
        return redirect()->route('lab_requests')->with('status', 'Lab Request successfully declared incomplete');
        }
        else
        {
        return redirect()->route('home')->with('status', 'Lab Request successfully declared incomplete');
        }
    }

    public function remarks($id, Request $request)
    {
        $this->lab_request->remarks($id, $request);
        return redirect()->route('lab_requests')->with('status', 'Remarks Added');
    }
}
