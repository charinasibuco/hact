<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PatientTransfer;
use Auth;

class PatientTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function transfer(Requests\PatientTransferRequest $request)
    {
        if(Auth::user()->access != 1)
        {
            abort(403);
        }
        
        $input[] = $request->except('_token');
        if(is_object(PatientTransfer::where('patient_id', $request->patient_id)->first()))
        {
            
            $transfer = PatientTransfer::where('patient_id', $request->patient_id)->first();
            $transfer->patient_id = $request->patient_id;
            $transfer->transfer = $request->transfer;
            $transfer->transfer_date = $request->transfer_date;
            $transfer->save();
        }
        else
        {
            $transfer = new PatientTransfer;
            $transfer->patient_id = $request->patient_id;
            $transfer->transfer = $request->transfer;
            $transfer->transfer_date = $request->transfer_date;
            $transfer->save();
        }
        return redirect()->route('patient')->with('status','Patient successfully transferred!'); 
    }

    public function update(Request $request)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
