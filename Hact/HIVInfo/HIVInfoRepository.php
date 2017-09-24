<?php
namespace Hact\HIVInfo;

use Hact\Repository;
use Auth;
use App\HIVInfo;
use App\ActivityLog;
use Illuminate\Support\Facades\DB as db;


/**
 * Class HIVInfoRepository
 * @package Hact\HIVInfo
 */
class HIVInfoRepository extends Repository{
    const LIMIT = 50;

    /**
     * HIVInfoRepository constructor.
     * @param HIVInfo $hiv_info
     * @param ActivityLog $log
     */
    public function __construct(HIVInfo $hiv_info,ActivityLog $log)
    {
        $this->user = Auth::user();
        $this->hiv_info = $hiv_info;
        $this->log = $log;
    }

    /**
     * @return string
     */
    public function model(){
        $this->user = Auth::user();
        return "App\\HIVInfo";
    }

    /** get all HIV Info with the passed type
     * @param null $type
     * @return mixed
     */
    public function getHIVInfo($type=null)
    {
        $data = [];
        $data['type'] = $type;
        if($type==1 || $type==null)
        {
            $data['page'] = 'Philippine Registry';
            $type = 1;
        }
        elseif($type==2)
        {
            $data['page'] = 'Situationer';
        }
        elseif($type==3)
        {
            $data['page'] = 'Western Visayas Registry';
        }
        $data['hiv_info'] = $this->hiv_info->where('type', (($type!=null) ? $type:1))->orderBy('created_at','desc')->paginate(self::LIMIT);
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type)
    {
        $data = [];
        $data['type'] = $type;
        if($data['type']==1)
        {
            $data['page'] = 'Philippine Registry';
        }
        elseif($data['type']==2)
        {
            $data['page'] = 'Situationer';
        }
        elseif($data['type']==3)
        {
            $data['page'] = 'Western Visayas Registry';
        }

        $data['action_name'] = 'Add';
        $data['action'] = route('hiv_info_store');
        $data['description'] = old('description');
        $data['file'] = old('file');
        $data['image'] = old('image');

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($input, $request)
    {
        $input = $request->except(['image','file']);
        $max = DB::table('hiv_info')->max('id');
        $count = $max+1;
        $extension = $request->image->getClientOriginalExtension();
        $image_path = 'images/hiv_info/';
        $request->image->move($image_path,$count.'.'.$extension);
        $input['image'] = $image_path.$count.'.'.$extension;

        $file_path = 'files/hiv_info/';
        $request->file->move($file_path, $request->file->getClientOriginalName());
        $input['file'] = $file_path.$request->file->getClientOriginalName();

        $input['user_id'] = Auth::user()->id;
        $this->hiv_info->create($input);

        $this->log->create([
            'page' => "HIV Info",
            'message' => 'New File '.$input['description'].'has been uploaded!',
            'user_id' => $this->user->id
        ]);
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
        $hiv_info = $this->hiv_info->where('id', $id)->first();
        $data['type'] = $hiv_info->type;

        if($data['type']==1)
        {
            $data['page'] = 'Philippine Registry';
        }
        elseif($data['type']==2)
        {
            $data['page'] = 'Situationer';
        }
        elseif($data['type']==3)
        {
            $data['page'] = 'Western Visayas Registry';
        }

        $data['action_name'] = 'Edit';

        $data['action'] = route('hiv_info_update', $id);

        $data['description'] = $hiv_info->description;
        $data['file'] = $hiv_info->file;
        $data['image'] = $hiv_info->image;

        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($request, $id, $input)
    {
        //$count = HIVInfo::all()->count() + 1;

        $input = $request->except(['image','file','_token','ui_code']);

        if(isset($request->file))
        {
            $file_path = 'files/hiv_info/';
            $request->file->move($file_path, $request->file->getClientOriginalName());
            $input['file'] = $file_path.$request->file->getClientOriginalName();
        }

        if(isset($request->image))
        {
            $max = DB::table('hiv_info')->max('id');
            $count = $max+1;

            $extension = $request->image->getClientOriginalExtension();
            $image_path = 'images/hiv_info/';
            $request->image->move($image_path,$count.'.'.$extension);
            $input['image'] = $image_path.$count.'.'.$extension;
        }
        $input['user_id'] = $this->user->id;
        $this->hiv_info->where('id',$id)->update($input);

        $this->log->create([
            'page' => "HIV Info",
            'message' => 'File '.$input['description'].'has been updated!',
            'user_id' => $this->user->id
        ]);
    }


    /**Display the File in the Landing Page
     * @param $type
     * @param $id
     */
    public function display($type, $id)
    {
        $this->hiv_info->where('type', $type)->update(['display' => 0]);
        $this->hiv_info->where('id', $id)->update(['display' => 1]);

        $this->log->create([
            'page' => "HIV Info",
            'message' => $this->hiv_info->description.' has been displayed in the Landing Page!',
            'user_id' => $this->user->id
        ]);
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

    /**
     * @param $id
     */
    public function search($id)
    {
        //
    }

    /**
     * @param $id
     */
    public function find($id)
    {
        //
    }

}