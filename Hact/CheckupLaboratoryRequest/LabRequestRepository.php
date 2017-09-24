<?php
namespace Hact\CheckupLaboratoryRequest;

use Hact\Repository;
use Auth;
use App\Patient;
use App\CheckupLaboratoryRequest;
use App\ActivityLog;

/**
 * Class LabRequestRepository
 * @package Hact\CheckupLaboratoryRequest
 */
class LabRequestRepository extends Repository{
    const LIMIT = 50;

    /**
     * LabRequestRepository constructor.
     * @param Patient $patient
     * @param CheckupLaboratoryRequest $lab_request
     * @param ActivityLog $log
     */
    public function __construct(CheckupLaboratoryRequest $lab_request,ActivityLog $log)
    {
        $this->user = Auth::user();
        $this->lab_request = $lab_request;
        $this->log = $log;
    }

    /**
     * @return string
     */
    public function model()
    {
        $this->user = Auth::user();
        return "App\\CheckupLaboratoryRequest";
    }

    /**Get All the Lab Request
     * @param $request
     * @return array
     */
    public function getLabRequests($request, $status)
    {
        $lab_status     = 'all';
        if($status == 'incomplete'){
            $lab_status = 0;
        }elseif($status == 'complete'){
            $lab_status = 1;
        }

        $data = [];
        $data['search'] = '';
        $data['order_by'] = $this->order_by($request);
        $data['sort'] = $this->sort($request);

        if ($request->has('search')) {
            $data['search'] = trim($request->input('search'));
            $query = $this->lab_request->leftJoin('laboratory_test', 'laboratory_test.id', '=', 'checkup_laboratory_request.laboratory_test_id')
                ->leftJoin('checkup', 'checkup.id', '=', 'checkup_laboratory_request.checkup_id')
                ->leftJoin('patient', 'patient.id', '=', 'checkup.patient_id')
                ->where('description', 'LIKE', '%' . $data['search'] . '%')
                ->orWhere('code_name', 'LIKE', '%' . $data['search'] . '%')
                ->select('checkup_laboratory_request.*');
            //$data['lab_requests'] = $query->get();
        } else {
            $query = $this->lab_request->leftJoin('laboratory_test', 'laboratory_test.id', '=', 'checkup_laboratory_request.laboratory_test_id')
                ->leftJoin('checkup', 'checkup.id', '=', 'checkup_laboratory_request.checkup_id')
                ->leftJoin('patient', 'patient.id', '=', 'checkup.patient_id')
                ->select('checkup_laboratory_request.*');
        }
        if($status != 'all'){
            $query->where('status', '=', $lab_status);
        }

        $data['lab_requests'] = $query->orderBy($data['order_by'], $data['sort'])->paginate(self::LIMIT);
        $data['patient_sort'] = $this->link_sort('patient.code_name', $data['search'], $data['sort'], $request);
        $data['status'] = $this->link_sort('status', $data['search'], $data['sort'], $request);
        $data['remarks'] = $this->link_sort('remarks', $data['search'], $data['sort'], $request);
        $data['lab_request'] = $this->link_sort('laboratory_test.description', $data['search'], $data['sort'], $request);
        $data['checkup_date'] = $this->link_sort('checkup.checkup_date', $data['search'], $data['sort'], $request);
        $data['follow_up_date'] = $this->link_sort('checkup.follow_up_date', $data['search'], $data['sort'], $request);
        $data['pagination'] = ['search' => $data['search'], 'order_by' => $data['sort'], 'sort' => $request];

        return $data;
    }

    /**set a Lab Request as Complete
     * @param $id
     * @param $request
     */
    public function complete($id, $request)
    {
        $lab_request = $this->lab_request->where('id',$id)->first();
        $lab_request->status = 1;
        $lab_request->save();
        $this->log->create([
            'page' => 'Checkup Laboratory Request',
            'message' => $lab_request->LaboratoryTest->description.' for ' . $this->lab_request->where('id',$id)->first()->Checkup->Patient->code_name . ' has been completed!',
            'user_id' => Auth::user()->id
        ],$request);
    }

    /**set a Lab Request as Incomplete
     * @param $id
     * @param $request
     */
    public function incomplete($id, $request)
    {
        $lab_request = $this->lab_request->where('id',$id)->first();
        $lab_request->status = 0;
        $lab_request->save();
        $this->log->create([
            'page' => 'Checkup Laboratory Request',
            'message' => $lab_request->LaboratoryTest->description.' for ' . $this->lab_request->where('id',$id)->first()->Checkup->Patient->code_name . ' has been set to incomplete!',
            'user_id' => $this->user->id
        ],$request);

    }

    public function remarks($id, $request)
    {
        $input = $request->only(['remarks']);
        $this->lab_request->find($id)->update($input);
        $this->log->create([
            'page' => 'Checkup Laboratory Request',
            'message' => $this->lab_request->find($id)->LaboratoryTest->description.' for ' . $this->lab_request->find($id)->Checkup->Patient->code_name . ' has been remarked.',
            'user_id' => $this->user->id
        ],$request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($input, $request)
    {
        //
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
        //
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
        //
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

    public function search($id)
    {
        //
    }

    public function find($id)
    {
        //
    }

    /**Order Table
     * @param $request
     * @return string
     */
    public function order_by($request)
    {
        if($request->has('order_by'))
        {
            $order_by = trim($request->order_by);

            if($order_by == 'patient.code_name')
            {
                return 'patient.code_name';
            }
            elseif($order_by == 'laboratory_test.description')
            {
                return 'laboratory_test.description';
            }
            elseif($order_by == 'checkup.checkup_date')
            {
                return 'checkup.checkup_date';
            }
            elseif($order_by == 'checkup.follow_up_date')
            {
                return 'checkup.follow_up_date';
            }
            elseif($order_by == 'status')
            {
                return 'status';
            }
            elseif($order_by == 'remarks')
            {
                return 'remarks';
            }
            else
            {
                return 'patient.code_name';
            }
        }
        else
        {
            return 'patient.code_name';
        }
    }

    /**Sort Table
     * @param $request
     * @return string
     */
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

    /**Link Sort
     * @param $order_by
     * @param $search
     * @param $sort
     * @param $request
     * @return string
     */
    public function link_sort($order_by, $search, $sort, $request)
    {
        $sort  = ($sort == 'DESC')? 'ASC' : 'DESC';

        if($request->has('page'))
        {
            return route('lab_requests', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort, 'page' => $request->input('page')]);
        }
        else
        {
            return route('lab_requests', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort]);
        }
    }
}