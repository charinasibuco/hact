<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Symptoms;
use Auth;

class SymptomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->access != 1)
        {
            abort(403);
        }
        /*$doctor     = Auth::user()->id;
        $access     = Auth::user()->access;*/
        $paginate   = 30;
        $search     = '';
        $order_by   = $this->order_by($request);
        $sort       = $this->sort($request);

        if($request->has('search'))
        {
            $search = trim($request->input('search'));
             $symptoms = Symptoms::where('pill', 'LIKE', '%' . $search . '%')
                        ->orWhere('symptoms', 'LIKE', '%' . $search . '%')
                        ->orWhere('monitoring', 'LIKE', '%' . $search . '%')
                        ->orderBy($order_by, $sort) 
                        ->paginate($paginate);
        }
        else
        {
            $symptoms = Symptoms::orderBy($order_by, $sort)->paginate($paginate);
        }

        $pill_sort     = $this->link_sort('pill', $search, $sort, $request);
        $symptoms_sort        = $this->link_sort('symptoms', $search, $sort, $request);
        $monitoring_sort        = $this->link_sort('monitoring', $search, $sort, $request);
        $pagination         = ['search' => $search, 'order_by' => $order_by, 'sort' => $sort];

        $data = compact('pill_sort', 'symptoms_sort','monitoring', 'pagination', 'symptoms', 'monitoring_sort');
    
        return view('hact.symptoms.index', $data);
    }


    public function search(Request $request)
    {
        $search = '%' . trim($request->input('search')) . '%';

        $symptoms = Symptoms::where('pill', 'LIKE', $search)
                            ->orWhere('symptoms', 'LIKE', $search) 
                            ->orWhere('monitoring', 'LIKE', $search)            
                            ->take(30)
                            ->lists('pill', 'symptoms','monitoring');

        return response()->json($symptoms);
    }

    public function order_by($request)
    {
        if($request->has('order_by'))
        {
            $order_by = trim($request->order_by);

            if($order_by == 'pill')
            {
                return 'pill';
            }
            elseif($order_by == 'symptoms')
            {
                return 'symptoms';
            }
            elseif($order_by == 'monitoring')
            {
                return 'monitoring';
            }
            else
            {
                return 'pill';
            }
        }
        else
        {
            return 'pill';
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
            return route('symptoms', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort, 'page' => $request->input('page')]);
        }
        else
        {
            return route('symptoms', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->access != 1)
        {
            abort(403);
        }
        $action = route('symptoms_store');
        $pill = old('pill');
        $monitoring = old('monitoring');
        $symptom = old('symptoms');
        $page = 'Create';

        $data = compact('pill','symptom','monitoring','action','page');
        return view('hact.symptoms.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\SymptomsStoreRequest $request)
    {
        $input = $request->except(['_token']);
        Symptoms::create($input);
        return redirect()->route('symptoms_create')->with('status', 'Symptoms record successfully created.');

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
        if(Auth::user()->access != 1)
        {
            abort(403);
        }
        $symptoms = Symptoms::where('id', $id)->first();
        $action = route('symptoms_update', $id);
        $pill = $symptoms->pill;
        $symptom = $symptoms->symptoms;
        $monitoring = $symptoms->monitoring;
        $page = 'Edit';

        $data = compact('pill','symptom','monitoring','action','page');
        return view('hact.symptoms.form', $data);
        #dd($symptoms);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\SymptomsUpdateRequest $request, $id)
    {
        $input = $request->except(['_token']);
        Symptoms::where('id', $id)->update($input);
        return redirect()->route('symptoms')->with('status', 'Symptoms record successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
