<?php
namespace Hact\CheckupReferrals;

use Hact\Repository;
use Auth;
use App\Patient;
use App\CheckupReferrals;
use App\ActivityLog;

class ReferralsRepository extends Repository{
    const LIMIT = 50;

    public function __construct(Patient $patient,CheckupReferrals $referral,ActivityLog $log)
    {
        $this->user = Auth::user();
        $this->patient = $patient;
        $this->referral = $referral;
        $this->log = $log;
    }

    public function model()
    {
        $this->user = Auth::user();
        return "App\\CheckupReferrals";
    }

    public function getReferrals($request)
    {
        $data = [];
        $data['search']     = '';
        $data['order_by']   = $this->order_by($request);
        $data['sort']       = $this->sort($request);
        if($request->has('search'))
        {
            $search     = trim($request->input('search'));
            $query      = $this->referral->leftJoin('checkup','checkup_referrals.checkup_id','=','checkup.id')
                ->join('patient','patient.id', '=', 'checkup.patient_id')
                ->where('reason', 'LIKE', '%' . $search . '%')
                ->orWhere('code_name', 'LIKE', '%' . $search. '%')
                ->select('checkup_referrals.*');
        }
        else{
            $query      = $this->referral->leftJoin('checkup','checkup_referrals.checkup_id','=','checkup.id')
                ->join('patient','patient.id', '=', 'checkup.patient_id')
                ->select('checkup_referrals.*');
        }

        $data['referrals']        = $query->orderBy( $data['order_by'], $data['sort'])->paginate(self::LIMIT);
        $data['patient_sort']   = $this->link_sort('patient.code_name', $data['search'], $data['sort'], $request);
        $data['reason_sort']    = $this->link_sort('checkup_referrals.reason',$data['search'], $data['sort'], $request);
        $data['checkup_date']   = $this->link_sort('checkup.checkup_date',$data['search'], $data['sort'], $request);
        $data['follow_up_date'] = $this->link_sort('checkup.follow_up_date', $data['search'], $data['sort'], $request);
        $data['surgeon_sort'] = $this->link_sort('checkup_referrals.surgeon', $data['search'], $data['sort'], $request);
        $data['ob_gyne_sort'] = $this->link_sort('checkup_referrals.ob_gyne', $data['search'], $data['sort'], $request);
        $data['opthamology_sort'] = $this->link_sort('checkup_referrals.ophthamology', $data['search'], $data['sort'], $request);
        $data['dentis_sort'] = $this->link_sort('checkup_referrals.dentis', $data['search'], $data['sort'], $request);
        $data['psychiatrist_sort'] = $this->link_sort('checkup_referrals.psychiatrist', $data['search'], $data['sort'], $request);
        $data['others_sort'] = $this->link_sort('checkup_referrals.others', $data['search'], $data['sort'], $request);


        $data['pagination']     = ['search' => $data['search'], 'order_by' => $data['order_by'], 'sort' => $data['sort']];
        return $data;
    }

    public function complete($id, $referral, $request)
    {
        $checkup_referral = $this->referral->where('id',$id)->first();
        if($referral == 1)
        {
            $checkup_referral->surgeon = 2;
            $description = "Surgery";
        }
        if($referral == 2)
        {
            $checkup_referral->ob_gyne = 2;
            $description = "OB Gyne";
        }
        if($referral == 3)
        {
            $checkup_referral->opthamology = 2;
            $description = "Opthal";
        }
        if($referral == 4)
        {
            $checkup_referral->dentis = 2;
            $description = "Dentist";
        }
        if($referral == 5)
        {
            $checkup_referral->psychiatrist = 2;
            $description = "Psych";
        }
        if($referral == 6)
        {
            $checkup_referral->others_status = 2;
            $description = $checkup_referral->others;
        }

        $checkup_referral->save();

        $this->log->create([
            'page' => 'Checkup Referrals',
            'message' => $description.' for ' . $this->referral->where('id',$id)->first()->Checkup->Patient->code_name . ' has been completed!',
            'user_id' => $this->user->id
        ],$request);
    }

    public function incomplete($id, $referral, $request)
    {
        $checkup_referral = $this->referral->where('id',$id)->first();
        if($referral == 1)
        {
            $checkup_referral->surgeon = 1;
            $description = "Surgery";
        }
        if($referral == 2)
        {
            $checkup_referral->ob_gyne = 1;
            $description = "OB Gyne";
        }
        if($referral == 3)
        {
            $checkup_referral->opthamology = 1;
            $description = "Opthal";
        }
        if($referral == 4)
        {
            $checkup_referral->dentis = 1;
            $description = "Dentist";
        }
        if($referral == 5)
        {
            $checkup_referral->psychiatrist = 1;
            $description = "Psych";
        }
        if($referral == 6)
        {
            $checkup_referral->others_status = 1;
            $description = $checkup_referral->others;
        }

        $checkup_referral->save();

        $this->log->create([
            'page' => 'Checkup Referrals',
            'message' => $description.' for ' . $this->referral->where('id',$id)->first()->Checkup->Patient->code_name . ' has been completed!',
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

    public function order_by($request)
    {
        if($request->has('order_by'))
        {
            $order_by = trim($request->order_by);

            if($order_by == 'patient.code_name')
            {
                return 'patient.code_name';
            }
            elseif($order_by == 'checkup_referrals.reason')
            {
                return 'checkup_referrals.reason';
            }
            elseif($order_by == 'checkup_referrals.surgeon')
            {
                return 'checkup_referrals.surgeon';
            }
            elseif($order_by == 'checkup_referrals.ob_gyne')
            {
                return 'checkup_referrals.ob_gyne';
            }
            elseif($order_by == 'checkup_referrals.ophthamology')
            {
                return 'checkup_referrals.ophthamology';
            }
            elseif($order_by == 'checkup_referrals.dentis')
            {
                return 'checkup_referrals.dentis';
            }
            elseif($order_by == 'checkup_referrals.psychiatrist')
            {
                return 'checkup_referrals.psychiatrist';
            }
            elseif($order_by == 'checkup_referrals.others')
            {
                return 'checkup_referrals.others';
            }
            elseif($order_by == 'checkup.checkup_date')
            {
                return 'checkup.checkup_date';
            }
            elseif($order_by == 'checkup.follow_up_date')
            {
                return 'checkup.follow_up_date';
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
            return route('referrals', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort, 'page' => $request->input('page')]);
        }
        else
        {
            return route('referrals', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort]);
        }
    }
}