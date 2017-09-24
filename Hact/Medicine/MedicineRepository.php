<?php
/**
 * Created by PhpStorm.
 * User: Jaime
 * Date: 12/16/2015
 * Time: 4:46 PM
 */

namespace Hact\Medicine;

use Hact\Repository;
use App\MedicineHistory;
use App\MedicineModel;
use App\ActivityLog;
use App\MedicineInventory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class MedicineRepository extends Repository{

    const LIMIT         = 50;
    const SORT          = 'DESC';
    const ORDER_BY      = 'id';
    const WARNING_QTY   = 100;
    const CRITICAL_QTY  = 20;

    protected $user;


    public function model()
    {
        $this->user = Auth::user();
        return 'App\MedicineModel';
    }
    /**
     * Find medicine method
     * @param $id
     * @return mixed
     */
    public function find($id){
        return $this->model->find($id);
    }

    public function all(){
        return $this->model->all();
    }
    /**
     * Get all medicine method
     * @param null $request
     * @return mixed
     */
    public function getMedicine($request = null){
        $search = trim($request->input('search'));
        if($request->has('search')){
            return $this->model->where('name', 'LIKE', '%'.$request->input('search') .'%')
                        ->orWhere('item_code', 'LIKE', '%' .$search. '%')
                        ->orWhere('tabs_per_bottle', 'LIKE', '%' .$search. '%')
                        ->orWhere('expiry_date', 'LIKE', '%' .$search. '%')
                        ->orWhere('quantity', 'LIKE', '%' .$search. '%')
                        ->orWhere('suggested_dosage', 'LIKE', '%' .$search. '%')
                        ->orWhere('lot_number', 'LIKE', '%' .$search. '%')
                        ->orderBy('name', $request->input('sort'))
                        ->paginate(self::LIMIT);
        }

        if($request->input('order_by') && $request->input('sort')){
            return $this->model->orderBy($request->input('order_by'), $request->input('sort'))->paginate(self::LIMIT);
        }

        return $this->model->orderBy('id', 'desc')->paginate(self::LIMIT);
    }

    public function getReStockMedicine(){
        return  $this->model->orderBy('id', 'desc')->get();
    }

    public function restock(){
        $data['medicine_id']    = old('medicine_id');
        $data['tabs_per_bottle']= old('tabs_per_bottle');
        $data['lot_number']     = old('lot_number');
        $data['quantity']       = old('quantity');
        $data['expiry_date']    = old('expiry_date'); 

        return $data;
    }

    /**
     * Get all medicine history method
     * @param $request
     * @return mixed
     */
    public function getMedicineHistory($request){
        if($request->has('order_by')){
            return MedicineHistory::with(['medicine'])->orderBy($request->input('order_by'), $request->input('sort'))->paginate(self::LIMIT);
        }
        return MedicineHistory::orderBy('id', 'desc')->paginate(self::LIMIT);
    }

    /**
     * Get all expire medicine method
     * @param $request
     * @return mixed
     */
    public function getExpiredMedicines($request){
        $from       = Carbon::parse($request->input('from_date'))->format('Y-m-d');
        $to         = Carbon::parse($request->input('to_date'))->format('Y-m-d');
        return $this->model->whereBetween('expiry_date', [$from, $to])
                ->orderBy($request->input('order_by'), $request->input('sort'))
                ->paginate(self::LIMIT);
    }

    /**
     * Get all medicines having low stocks
     * @param $request
     * @return mixed
     */
    public function getLowStockMedicines($request){
        if($request->has('order_by')){
            return $this->model->where('quantity','<', self::WARNING_QTY)
                ->orderBy($request->input('order_by'), $request->input('sort'))
                ->paginate(self::LIMIT);
        }

        return $this->model->where('quantity','<', self::WARNING_QTY)
            ->paginate(self::LIMIT);
    }
    public function create($id)
    {   
        $data['name']               = old('name');
        $data['item_code']          = old('item_code');
        $data['tabs_per_bottle']    = old('tabs_per_bottle');
        $data['classification']     = old('classification');
        $data['suggested_dosage']   = old('suggested_dosage');

        return $data;
    }
    public function edit($id){
        //
    }
    public function store($input, $request)
    {
        $medicine_history = $this->model->select('id')->orderBy('id', 'desc')->first();
        $input =  $request->except('_token');
        $this->model->create($input);

        return ['status' => true, 'results'=> 'Success'];
    }

    public function update($id, $input, $request)
    {
        $input =  $request->except('_token');
        $this->model->find($id)->update($input);

        return ['status' => true, 'results' => 'Success'];
    }

    public function destroy($id){
        return $this->model->find($id)->delete();
    }

    public function search($input){

        $validator      = Validator::make($input, ['search' => 'required']);

        if ($validator->fails()) {
            return ['status' => false, 'results' => $validator];
        }
        $results        = $this->model->SearchMedicineList($input['search'])->paginate(self::LIMIT);
        return ['status' => true, 'results' => $results];

    }

}