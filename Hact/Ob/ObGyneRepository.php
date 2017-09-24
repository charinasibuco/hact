<?php
/**
 * Created by PhpStorm.
 * User: Jaime
 * Date: 12/22/2015
 * Time: 1:22 PM
 */

namespace Hact\Ob;
use Hact\Repository;


use Hact\Log\ActivityLogRepository as ActivityLog;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\ObGyne;

use App\Patient;

class ObGyneRepository extends Repository{

    protected $user;
    private $patient;

    private $obgyne;
    private $log;
    const LIMIT         = 15;

    /**
     * Inject Dependencies
     *
     * @param      Patient      $patient  (description)
     * @param      ObGyne       $obgyne   (description)
     * @param      ActivityLog  $log      (description)
     */


    public function __construct(Patient $patient,ObGyne $obgyne,ActivityLog $log)
    {
       $this->patient = $patient;
       $this->obgyne = $obgyne;
       $this->log = $log;
       $this->user =  Auth::user();
    }

    public function model()
    {
        $this->user = Auth::user();
        return 'App\ObGyne';
    }

    public function getObGynes($request){
        if($request->has('search')){
            return   $this->patient->whereIn('id', function($query){
                $query->select('patient_id')->from('ob');
            })
                ->where('ui_code', 'like', '%%'.$request->input('search').'%%')
                ->orWhere('code_name', 'like', '%%'.$request->input('search').'%%')
                ->orWhere('saccl_code', 'like', '%%'.$request->input('search').'%%')
                ->select('id','ui_code', 'code_name', 'saccl_code', DB::raw('(select max(if_delivered_date) from ob where patient_id = patient.id) as max_delivered_date'))
                ->orderBy($request->input('order_by'), $request->input('sort'))
                ->paginate(self::LIMIT);
        }

        if($request->has('order_by') && $request->has('sort')){
            return   $this->patient->whereIn('id', function($query){
                $query->select('patient_id')->from('ob');
            })
            ->select('id','ui_code', 'code_name', 'saccl_code', DB::raw('(select max(if_delivered_date) from ob where patient_id = patient.id) as max_delivered_date'))
            ->orderBy($request->input('order_by'), $request->input('sort'))
            ->paginate(self::LIMIT);
        }

        return   DB::table('patient')
                    ->whereIn('id', function($query){
                    $query->select('patient_id')->from('ob')->get();
            })

        ->select('id','ui_code', 'code_name', 'saccl_code',  DB::raw('(select max(if_delivered_date) from ob where patient_id = patient.id) as max_delivered_date'))
        ->orderBy('max_delivered_date', 'desc')
        ->paginate(self::LIMIT);
    }

    public function getPatients($request){
        $results            = [];
        $patients           =   $this->patient->where('code_name','like','%%%'.$request->input('q').'%%')->get();
        foreach($patients as $patient){
            $results[]      = ['id' => $patient->id, 'name' => $patient->code_name];
        }

        return $results;
    }

    public function find($id){

        return  $this->obgyne->with(['patient'])->find($id);

        return $this->obgyne->with(['patient'])->find($id);

    }

    public function findId($id){
        return $this->model->find($id);
    }

    public function findPatient($id){
        return   $this->patient->find($id);
    }

    public function create($id){
        $patient_id                 = $id;
        $search_vct                 = old('search_vct');
        $patient                    = old('patient');
        $currently_pregnant         = old('currently_pregnant');
        $gestation_age              = old('gestation_age');
        $delivery_date              = old('delivery_date');
        $feeding_type               = old('feeding_type');
        $pap_smear                  = old('pap_smear');
        $data                       = compact('currently_pregnant', 'gestation_age', 'delivery_date', 'feeding_type','search_vct', 'patient_id','pap_smear','patient');
        $data['name']               = '';
        $data['action'] = route('ob_gyne_store');
        $data['action_name'] = 'Create';
        if($id != 0){
            $result                 = $this->findPatient($id);
            $data['search_vct']     = $result->code_name;
            $data['name']           = $result->code_name;
            $data['gender']         = $result->gender;
        }

        return $data;

    }

    public function store($input, $request){
        $input          = $request->all();
        $messages       = [
                            'required'      => 'The :attribute is required',
                            'required_if'   => 'The :attribute is required',

                        ];
        $validator      = Validator::make($input, [
            'patient_id'               => 'required',
            'gestation_age'           => 'required_if:currently_pregnant,1',
            'currently_pregnant'    => 'required'
        ], $messages);

        if ($validator->fails()) {
            return ['status' => false, 'results' => $validator];
        }

        $ob                                         = new ObGyne;
        $ob->patient_id                             = $input['patient_id'];
        $ob->currently_pregnant                     = $input['currently_pregnant'];
        $ob->pap_smear                              = $input['pap_smear'];
        $ob->currently_pregnant_if_yes_gestation_age= $input['gestation_age'];
        if($request->has('feeding_type')){
            $ob->infant_type                            = $input['feeding_type'];
        }

        if($request->has('delivery_date')){
            $ob->if_delivered_date                  = $input['delivery_date'];
        }

        $ob->user_id                                = $this->user->id;
        if($ob->save())
        {
            $patient =   $this->patient->where('id', $input['patient_id'])->first();
            $this->log->create([
                    'page' => 'Ob Gyne',
                    'message' => $patient->code_name . ' has been created!',
                    'user_id' => $this->user->id
                ],$request);

            return ['status' => true, 'results' => 'Success'];
        }

        return ['status' => false, 'results' => 'Unable to save OB records'];
    }

    public function update($request, $id, $input){
        if($request->has('gestation_age') && $request->has('delivery_date')){
            $messages       = [
                'required'      => 'The :attribute is required',
                'required_if'   => 'The :attribute is required',
            ];
            $validator      = Validator::make($input, [
                'gestation_age'           => 'required_if:currently_pregnant,1',
                'currently_pregnant'    => 'required'
            ], $messages);

            if ($validator->fails()) {
                return ['status' => false, 'results' => $validator];
            }
        }
        $ob                                         =  $this->obgyne->find($id);
        $ob->currently_pregnant                     = $input['currently_pregnant'];
        $ob->pap_smear                              = $input['pap_smear'];
        $ob->currently_pregnant_if_yes_gestation_age= $input['gestation_age'];
        $ob->infant_type  = isset($input['feeding_type']) ? $input['feeding_type']: "";
        $ob->if_delivered_date = isset($input['feeding_type']) ? $input['delivery_date'] : "";
        //dd(isset($input['feeding_type']) ? $input['delivery_date'] : "");
        $ob->save();
        $patient =   $this->patient->where('id', $input['patient_id'])->first();
        $this->log->create([
                'page' => 'Ob Gyne',
                'message' => $patient->code_name . ' has been updated!',
                'user_id' => $this->user->id
            ],$request);

        return ['status' => true, 'results' => 'Success'];
    }

    public function edit($id){
        //
    }

    public function destroy($id){
        $ob = $this->obgyne->find($id);
        $patient_name = $ob->Patient->code_name;
        $ob->delete();

        $this->log->create([
            'page' => 'Tuberculosis',
            'message' => $patient_name . 'OB Gyne Record has been deleted!',
            'user_id' => $this->user->id
        ]);
    }

    public function search($request){

        $search     = '%' . trim($request->search_vct ). '%';

        $data =   $this->patient->whereIn('id', function($query){
                        $query->select('patient_id')->from('vct')->where('result', 2);
                    })
                    ->whereNotIn('id', function($query){
                        $query->select('patient_id')->from('mortality');
                    })
                    ->where('code_name', 'LIKE', $search)
                    ->where('gender', '=', 0)
                    ->take(20)
                    ->lists('code_name', 'id');
        return $data;
    }

    public function record($request){
        return $this->model->where('id', $request->id)->first();
    }

    public function obGyneHistory($id, $request){
        $order_by        = 'if_delivered_date';
        $sort           = 'desc';
        if($request->has('order_by')&& $request->has('sort')){
            $order_by        = $request->input('order_by');
            $sort           = $request->input('sort');
        }

        return $this->obgyne->where('patient_id', '=', $id )
            ->orderBy($order_by, $sort)
            ->paginate(self::LIMIT);
    }

    public function chart($request){
    
        $i                  = 0;
        $data               = [];
        $months             = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $date               = Carbon::now();
        $data['year']       = $date->year;
        $data['categories'] = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $range              = [];
        foreach ($months as $month)
        {
            $from           = Carbon::createFromTimestamp(strtotime(date($data['year'] . '-' . $month . '-1')))->format('Y-m-d');
            $to             = Carbon::createFromTimestamp(strtotime(date($data['year'] . '-' . $month . '-d')))->format('Y-m-t');
            $range          = ['from' => $from, 'to' => $to];

            $pregnant       = $this->obgyne->where(function($query) use($from, $to){

                $query->where('if_delivered_date','>=', $from)->where('if_delivered_date','<=',$to);
            })
                ->where('currently_pregnant', '=', 1)
                ->count();


            $non_pregnant   = $this->obgyne->where(function($query) use($from, $to){

                $query->where('if_delivered_date','>=', $from)->where('if_delivered_date','<=',$to);
            })
                ->where('currently_pregnant', '=', 0)
                ->count();
            $data['pregnant'][$i]       = $pregnant;
            $data['nonpregnant'][$i]    = $non_pregnant;
            $data['range'][$i]          = $range;
            $i++;
        }

        return $data;
    }

    public function dateDiff($time1, $time2, $precision = 6) {
        date_default_timezone_set("UTC");
        // If not numeric then convert texts to unix timestamps
        if (!is_int($time1)) {
            $time1 = strtotime($time1);
        }
        if (!is_int($time2)) {
            $time2 = strtotime($time2);
        }

        // If time1 is bigger than time2
        // Then swap time1 and time2
        if ($time1 > $time2) {
            $ttime = $time1;
            $time1 = $time2;
            $time2 = $ttime;
        }

        // Set up intervals and diffs arrays
        $intervals = array('year','month','day','hour','minute','second');
        $diffs = array();

        // Loop thru all intervals
        foreach ($intervals as $interval) {
            // Create temp time from time1 and interval
            $ttime = strtotime('+1 ' . $interval, $time1);
            // Set initial values
            $add = 1;
            $looped = 0;
            // Loop until temp time is smaller than time2
            while ($time2 >= $ttime) {
                // Create new temp time from time1 and interval
                $add++;
                $ttime = strtotime("+" . $add . " " . $interval, $time1);
                $looped++;
            }

            $time1 = strtotime("+" . $looped . " " . $interval, $time1);
            $diffs[$interval] = $looped;
        }

        $count = 0;
        $times = array();
        // Loop thru all diffs
        foreach ($diffs as $interval => $value) {
            // Break if we have needed precission
            if ($count >= $precision) {
                break;
            }
            // Add value and interval
            // if value is bigger than 0
            if ($value > 0) {
                // Add s if value is not 1
                if ($value != 1) {
                    $interval .= "s";
                }
                // Add value and interval to times array
                $times[] = $value . " " . $interval;
                $count++;
            }
        }

        // Return string with times
        return implode(", ", $times);
    }

}
