<?php

namespace App\Http\Controllers;

use Hact\Medicine\MedicineInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\MedicineModel;
use App\MedicineInventory;
use Illuminate\Support\Facades\Validator;
use Hact\Medicine\MedicineRepository;
use Hact\Medicine\MedicineInventoryRepository;
use Hact\Medicine\MedicineHistoryRepository;
use DB;
use Auth;
use Faker;

class MedicineController extends Controller
{
    protected $medicine;

    public function __construct(MedicineRepository $medicine, MedicineInventoryRepository $medicine_inventory, MedicineHistoryRepository $medicine_history){
        $this->medicine           = $medicine;
        $this->medicine_inventory = $medicine_inventory;
        $this->medicine_history   = $medicine_history;

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
    public function index(Request $request)
    {
        $data['search']     = trim($request->input('search'));
        $order_by   = $this->order_by($request);
        $sort       = ($request->input('sort') == 'asc') ? 'desc':'asc';
        $data['medicines']  = $this->medicine->getMedicine($request);

        $data['name']               = $this->link_sort('name', $data['search'], $sort, $request);
        $data['item_code']          = $this->link_sort('item_code', $data['search'], $sort, $request);
        $data['classification']     = $this->link_sort('classification', $data['search'], $sort, $request);
        $data['suggested_dosage']   = $this->link_sort('suggested_dosage', $data['search'], $sort, $request);
        $data['pagination']         = ['search' => $data['search'], 'order_by' => $order_by, 'sort' => $sort];
        
        return view('hact.item.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add($id=null)
    {
        $data = $this->medicine->create($id);
        return view('hact.item.add', $data);
    }

    public function history($id)
    {
        $data['medicine']   = $this->medicine->find($id)->where('id', $id)->first();
        $data['medicines']  = $this->medicine_inventory->find($id);
        $data['search']     = old('search');
        return view('hact.item.history', $data);
    }

    public function restock(Request $request)
    {
        $data                   = $this->medicine->restock();
        $data['medicines']      = $this->medicine->getReStockMedicine();
        
   
        return view('hact.item.restock', $data);
    }
    
    public function restockSave(Requests\MedicineRestockStoreRequest $request){
        $input              = $request->all();
        $result             = $this->medicine_inventory->store($input,$request);

        if($result['status'] == false){
            return redirect()->route('medicine_restock')->withErrors($result['results'])->withInput();
        }
        return redirect()->route('medicine_restock')->with('status', 'Successfully Updated!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\MedicineStoreRequest $request)
    {
        $input          = $request->all();
        $result         = $this->medicine->store($input, $request);
        if($result['status'] == false){
            return redirect()->route('medicine_add')->withErrors($result['results'])->withInput();
        }
        $this->medicine_history->store($input, $request);
        return redirect()->route('medicine')->with('status', 'Successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['medicine']       = $this->medicine->find($id);
        return view('hact.item.edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $data['id']         = $id;
        $medicine           = $this->medicine->find($id);
        $data['medicines']  = $this->medicine->getMedicine($request);
        $data['lot_number'] = $medicine->lot_number;
        $data['classification'] = $medicine->classification;
        $data['suggested_dosage'] = $medicine->suggested_dosage;


        return view('hact.item.restock', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\MedicineUpdateRequest $request, $id)
    {
        $input              = $request->all();
        $result             = $this->medicine->update($id, $input, $request);

        if($result['status'] == false){
            return redirect()->route('medicine_show', ['id' => $id])->withErrors($result['results'])->withInput();
        }
        $this->medicine_history->update($request, $id, $input);
        return redirect()->route('medicine_show', ['id' => $id])->with('status', 'Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $input                  = $request->all();
        $result                 = $this->medicine->search($input);
        if($result['status'] != false){
            $data['medicines'] = $result['results'];
            return view('hact.item.index', $data);
        }

        return redirect()->route('medicine')->withErrors($result['results'])->withInput();

    }

     public function order_by($request)
    {
        if($request->has('order_by'))
        {
            $order_by = $request->order_by;
            return $order_by;
        }
        else{
            return 'name';
        }
    }

    public function link_sort($order_by, $search, $sort, $request)
    {
        $sort     = ($request->input('sort') == 'asc') ? 'desc':'asc';

        if($request->has('page'))
        {
            return route('medicine', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort, 'page' => $request->input('page')]);

        }
        else
        {
            return route('medicine', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort]);
        }
    }
}
