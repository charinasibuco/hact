<?php

namespace Hact\medicine;

use Hact\Repository;
use Auth;

class MedicineInventoryRepository extends Repository{
	const LIMIT = 15;


	public function model(){
		$this->user = Auth::user();
		return 'App\MedicineInventory';
	}
	public function getMedicineInventory($request)
	{
		$data = $this->model->orderby('expiry_date', 'asc')->paginate(50);
		return $data;
	}
	public function find($id){
		$data = $this->model->where('medicine_id', $id)->orderBy('expiry_date', 'ASC')->paginate(50);
		return $data;
	}
	public function create($id){

	}

    public function store($input, $request){
    	$input = $request->except('_token');

    	$this->model->create($input);
        return ['status' => true, 'results' => Auth::user()];
    }

    public function edit($id){

    }

    public function update($request, $id, $input){

    }

    public function destroy($id){

    }

    public function search($string){

    }
}