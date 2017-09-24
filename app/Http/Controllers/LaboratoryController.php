<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\LaboratoryType;
use App\LaboratoryTest;
use App\LaboratoryTestType;
use App\Patient;
use App\User;
use DB;
use Hact\Log\ActivityLogRepository as ActivityLog;
use Hact\Laboratory\LaboratoryRepository as Laboratory;
use Auth;

class LaboratoryController extends Controller
{

    private $log;
    private $lab;
    private $patient;

    public function __construct(ActivityLog $log,Laboratory $lab,Patient $patient)
    {
        $this->log = $log;
        $this->lab = $lab;
        $this->patient = $patient;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function permission($id, $method)
    {
        $patient = Patient::join('patient_doctor','patient.id','=','patient_doctor.patient_id')
            ->where('user_id', Auth::user()->id);
        if($method=='edit' && $this->lab->find($id))
        {
            $patient = $patient->where('patient_id',$this->lab->find($id)->patient_id);
        }
        else
        {
            $patient = $patient->where('patient_id',$id);
        }
        $patient = $patient->first();
        if(Auth::user()->access != 1 && is_null($patient))
        {
            abort(403);
        }
    }

    public function index(Request $request)
    {
        if(Auth::user()->access != 1)
        {
            abort(403);
        }
        $access     = Auth::user()->access;
        $doctor     = Auth::user()->id;
        $paginate   = 50;
        $search     = '';
        $order_by   = $this->order_by($request);
        $sort       = $this->sort($request);

        $query = $this->patient->whereIn('id', function($query){

                    $query->select('patient_id')->from('vct')->where('result', 2);
                });

        if($access == 2)
        {
            $patients = $query->whereIn('id', function($query) use ($doctor){
                            $query->select('patient_id')->from('patient_doctor')->where('user_id', $doctor)->where('active', 1);
                        });
        }

        if($request->has('search'))
        {
            $search = trim($request->input('search'));
            $patients = $query->where(function($query) use ($search) {
                            $query
                            ->where('ui_code', 'LIKE', '%' . $search . '%')
                            ->orWhere('code_name', 'LIKE', '%' . $search . '%')
                            ->orWhere('saccl_code', 'LIKE', '%' . $search . '%');
                        });
        }

        $patients = $query->orderBy($order_by, $sort)->paginate($paginate);
        #dd($patients);
        $code_name_sort     = $this->link_sort('code_name_code', $search, $sort, $request);
        $birth_date_sort    = $this->link_sort('birth_date', $search, $sort, $request);
        $gender_sort        = $this->link_sort('gender', $search, $sort, $request);
        $saccl_code_sort    = $this->link_sort('saccl_code', $search, $sort, $request);
        $ui_code_sort       = $this->link_sort('ui_code', $search, $sort, $request);

        $pagination         = ['search' => $search, 'order_by' => $order_by, 'sort' => $sort];

        $data = compact(
                'patients', 'search',
                'ui_code_sort', 'code_name_sort', 'saccl_code_sort', 'birth_date_sort','gender_sort',
                'pagination'
            );



        return view('hact.laboratory.index', $data);
    }

    public function order_by($request)
    {
        if($request->has('order_by'))
        {
            $order_by = trim($request->order_by);

            if($order_by == 'ui_code')
            {
                return 'ui_code';
            }
            elseif($order_by == 'saccl_code')
            {
                return 'saccl_code';
            }
            elseif($order_by == 'code_name')
            {
                return 'code_name';
            }
            elseif($order_by == 'birth_date')
            {
                return 'birth_date';
            }
            elseif($order_by == 'gender')
            {
                return 'gender';
            }
            else
            {
                return 'code_name';
            }
        }
        else
        {
            return 'code_name';
        }
    }

    public function sort($request)
    {

        if($request->has('sort'))
        {
            $sort = $request->input('sort');

            if($sort == 'ASC')
            {
                return 'ASC';
            }
            elseif($sort == 'DESC')
            {
                return 'DESC';
            }
        }
        else
        {
            return 'ASC';
        }
    }

    public function link_sort($order_by, $search, $sort, $request)
    {
        $sort  = ($sort == 'DESC')? 'ASC' : 'DESC';

        if($request->has('page'))
        {
            return route('laboratory', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort, 'page' => $request->input('page')]);
        }
        else
        {
            return route('laboratory', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort]);
        }
    }

    public function search(Request $request)
    {
        $search = '%' . trim($request->input('search')) . '%';

        $patients = $this->patient->whereIn('id', function($query){
                            $query->select('patient_id')->from('vct')->where('result', 2);
                        })
                    ->where('code_name', 'LIKE', $search)
                    ->take(30)
                    ->lists('code_name', 'id');

        return response()->json($patients);
    }

    public function record(Request $request)
    {
        $patient = $this->patient->where('id', $request->id)->first();

        return $patient->toJson();
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        $data['laboratory_tests'] = LaboratoryTest::orderBy('group','asc')->get();
        $data['laboratory_types'] = LaboratoryType::all();
        $data['labs'] = [];
        $old_labs = old('labs');
        foreach($data['laboratory_types'] as $row){
                $data['labs'][$row->id] = isset($old_labs[$row->id])?$old_labs[$row->id]:"";
        }

        if(isset($old_labs['other'])){
            $data['labs']['other'] = $old_labs['other'];
        }

        if(isset($id))
        {
            $data['page'] = $this->patient->where('id', $id)->first()->code_name;
        }
        else
        {
            $data['page'] = old('page');
        }

        $data['action_name'] = "Create";

        $data['action'] = route('laboratory_store');


        $data['patient_id'] = $id;
        $data['search_patient'] = $this->patient->where('id', $id)->first()->code_name;

        $data['laboratory_test_id'] = old('laboratory_test_id');

        $data['laboratory_type_id'] = old('laboratory_type_id');

        $data['result'] = old('result');

        $data['result_date'] = old('result_date');

        $data['image'] = old('image');

        $data['other'] = old('other');

        return view('hact.laboratory.form',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\LaboratoryStoreRequest $request)
    {
        $input = $request->except(['search_patient', 'search_patient_url','patient_record_url', 'submit', '_token']);
        

        //$laboratory = new Laboratory;

        $max = DB::table('laboratory')->max('id');
        $count = $max+1;

        if(isset($input['image']))
        {
            $extension = $input['image']->getClientOriginalExtension();
            $path = 'images/laboratory/';
            $input['image']->move($path,$count.'.'.$extension);
            $input['image'] = $path.$count.'.'.$extension;
        }
        $input['result_date'] = date('Y-m-d', strtotime($input['result_date']));
        $input['user_id'] = Auth::user()->id;
        //dd($input['labs']);
        foreach($input['labs'] as $key => $result)
        {
                if($result != "")
                {
                    $input['result'] = $result;
                    $input['laboratory_type_id'] = $key;
                    $this->lab->store($input,$request);
                }

        }

        $patient = $this->patient->find($request->patient_id);
        $this->log->store([
                'page' => 'Laboratory',
                'message' => $patient->code_name . ' has been created!',
                'user_id' => Auth::user()->id
            ],$request);

        return redirect()->route('patient_profile', [$request->patient_id])->with('status', 'Laboratory Record successfully added to Patient!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    

    public function chart($id, $laboratory_test_id, $other = null)
    {
        $search_patient = $this->patient->where('id', $id)
                                    ->first()
                                    ->code_name;
        if($laboratory_test_id != 16)
        {
            $laboratory_name = LaboratoryTest::where('id', $laboratory_test_id)
                                            ->first()
                                            ->description;
        }
        else
        {   
            $laboratory_name = $other;
        }
        $patient_id = $id;
        $page = $search_patient;
        $action_name = 'Chart - '.$laboratory_name;

        $i             = 0;
        $array          = [];
        $laboratory_results = [];
        $laboratory_order = [];
        //$laboratory_list =[];
        if($laboratory_test_id != 16)
        {
            $laboratories       = $this->lab->getLaboratories($laboratory_test_id,$patient_id); 
        
            $first_laboratory  = $this->lab->getFirstLaboratory($laboratory_test_id);

            $last_laboratory   = $this->lab->getLastLaboratory($laboratory_test_id);
            
            $laboratory_types = LaboratoryType::where('laboratory_test_id',$laboratory_test_id)->get();

            foreach($laboratory_types as $type)
            {
                $data_array = [];
                foreach ($laboratories->where('laboratory_type_id', $type->id) as $row)
                {
                    array_push($data_array, $row->result);
                }

                array_push($laboratory_results, [
                        'name' => $type->description,
                        'data' => $data_array
                        ]);
            }


        }
        else
        {
            $laboratories      = $this->lab->getPatientLaboratory($patient_id,$other);
            $first_laboratory  = $this->lab->findByColumn('other',$other,'result_date','ASC',false);
            $last_laboratory   = $this->lab->findByColumn('other',$other,'result_date','DESC',false);
        
            $data_array = [];
                foreach ($laboratories as $row)
                {
                    array_push($data_array, $row->result);
                }

                array_push($laboratory_results, [
                        'name' => $other,
                        'data' => $data_array
                        ]);


        }

        $laboratory_check = ($laboratories->first()->other == "") ? $laboratories->where('laboratory_type_id', $laboratory_types->first()->id) : $laboratories;

        foreach ($laboratory_check as $row)
        {
            $laboratory_order[$i] = $row->result_date_format;
            $i++;
        } 

       
        $array['start_year']     = $first_laboratory->result_date_format;
        $array['last_year']      = $last_laboratory->result_date_format;
        $array['laboratory_results'] = $laboratory_results;
        //dd($array['laboratory_results']);
        $array['laboratory_order']    = $laboratory_order;



        $data = compact('array','laboratory_test_id','other','patient_id','search_patient','laboratory_name','page','action_name');
        return view('hact.laboratory.chart', $data);
    }

    public function generate_chart($id, $laboratory_test_id, $other = null)
    {
        $i             = 0;
        $data          = [];
        $laboratory_results = [];
        $laboratory_order = [];
     
        return response()->json($data);
    }
    public function show($id)
    {
        $this->permission($id,'edit');
        $laboratories = $this->lab->showLaboratories($id);                          
        $laboratory_tests = LaboratoryTest::orderBy('group','asc')->get();
        foreach($laboratory_tests as $key => $test)
        {
            $lab_type = LaboratoryType::where('laboratory_test_id',$test->id)->get();
            foreach($lab_type as $row)
            {
               if($laboratories->where('laboratory_type_id', $row->id)->count() == 0)
               {
                    unset($laboratory_tests[$key]);
               }
            }
            
        }
        $search_patient = $this->patient->where('id', $id)
                                    ->first()
                                    ->code_name;
        $other_laboratories = $this->lab->getOtherLaboratories();
        $patient_id = $id;
        $page = $search_patient;

        $data = compact('laboratories', 'laboratory_tests', 'search_patient', 'page', 'patient_id', 'other_laboratories');

        return view('hact.laboratory.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $this->permission($id,'edit');
        $data = $this->lab->edit($id);
        return view('hact.laboratory.form',$data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function update(Requests\LaboratoryStoreRequest $request, $id)
    {
        $patient = $this->patient->find($request->patient_id);
        $input = $request->except(['search_patient', 'search_patient_url','patient_record_url', 'submit', '_token','laboratory_test_id']);
        if(isset($input['image']))
        {
            //$max = DB::table('laboratory')->max('id');
            $count = $id;
            $extension = $input['image']->getClientOriginalExtension();
            $path = 'images/laboratory/';
            $input['image']->move($path,$count.'.'.$extension);
            $input['image'] = $path.$count.'.'.$extension;
            /*$this->lab
                ->where('created_at', $this->lab
                        ->where('id', $id)->first()->created_at)
                            ->update(['image' => $input['image']]);*/
        }
        $input['result_date'] = date('Y-m-d', strtotime($input['result_date']));
        $input['user_id'] = Auth::user()->id;

        $this->lab->update($request,$id,$input);
          $this->log->store([
                'page' => 'Laboratory',
                'message' => $patient->code_name . ' has been update!',
                'user_id' => Auth::user()->id
            ],$request);

        return redirect()->route('laboratory_edit', $id)->with('status', 'Laboratory record successfully updated.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = $this->lab->find($id)->patient_id;
        $this->lab->destroy($id);
        return redirect()->route('patient_profile', $patient)->with('status', 'Laboratory successfully deleted.');
    }

}
