<?php

namespace Hact\medicine;

use Hact\Repository;
use Auth;
use Carbon\Carbon;
use App\MedicineModel;

class MedicineHistoryRepository extends Repository{
	const LIMIT = 15;

    protected $user;

	public function model()
	{
		$this->user = Auth::user();
		return 'App\MedicineHistory';
	}

	public function getMedicineHistory($request){
		if($request->has('order_by')){
            return $this->model->with(['medicine'])->orderBy($request->input('order_by'), $request->input('sort'))->paginate(self::LIMIT);
        }
        return $this->model->orderBy('id', 'desc')->paginate(self::LIMIT);
	}

	public function find($id){

	}

    public function create($id){

    }

    public function store($input, $request){
    	$medicine_history   = MedicineModel::select('id')->orderBy('id', 'desc')->first();
    	$input 	= $request->all();
    	$datetimelog        = Carbon::now();
    	$log 				= $this->model;
        $log->medicine_id   = $medicine_history->id;
        $log->medicine_qty  = '0';
        $log->user_id       = '1';
        $log->log_date      = $datetimelog;
        $log->log_message   = ' Created medicine '. $input['name'] . ' at ' . $datetimelog;
        $log->save();
    }

    public function edit($id){

    }

    public function update($request, $id, $input){
    	$medicine_history   = MedicineModel::select('id')->where('id', $id)->first();
    	$input 	= $request->all();
    	$datetimelog        = Carbon::now();
    	$log 				= $this->model;
        $log->medicine_id   = $medicine_history->id;
        $log->medicine_qty  = '0';
        $log->user_id       = '1';
        $log->log_date      = $datetimelog;
        $log->log_message   = ' Updated medicine '. $input['name'] . ' at ' . $datetimelog;
        $log->save();
    }

    public function destroy($id){

    }

    public function search($string){

    }
}