<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Hact\HIVInfo\HIVInfoRepository as HIVInfo;
/**
 * Class HIVInfoController
 * @package App\Http\Controllers
 */
class HIVInfoController extends Controller
{
    /**
     * HIVInfoController constructor.
     * @param HIVInfo $hiv_info
     */
    public function __construct(HIVInfo $hiv_info){
        $this->hiv_info = $hiv_info;

        if(Auth::user()->access != 1)
        {
            abort(403);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type=null)
    {
        $data = $this->hiv_info->getHIVInfo($type);
        return view('hact.hiv_info.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        $data = $this->hiv_info->create($type);
        return view('hact.hiv_info.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\HIVInfoStoreRequest $request)
    {
        $this->hiv_info->store($input=null,$request);
        return redirect()->route('hiv_info_create', $request->type)->with('status','File successfuly uploaded');
    }

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
        $data = $this->hiv_info->edit($id);
        return view('hact.hiv_info.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\HIVInfoUpdateRequest $request, $id)
    {
        $this->hiv_info->update($request, $id, $input = null);
        return redirect()->route('hiv_info', $request->type)->with('status','Content succesfully updated!');
    }


    /**Displays the File in the Landing Page
     * @param $type
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function display($type, $id)
    {
        $this->hiv_info->display($type, $id);
        return redirect()->route('hiv_info', $type)->with('status','New display set!');
    }

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
