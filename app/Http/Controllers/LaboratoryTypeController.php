<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\LaboratoryType;

class LaboratoryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request)
    {
        /*$doctor     = Auth::user()->id;
        $access     = Auth::user()->access;*/
        $paginate   = 30;
        $search     = '';
        $order_by   = $this->order_by($request);
        $sort       = $this->sort($request);

        if($request->has('search'))
        {
            $search = trim($request->input('search'));
            $laboratory_types = LaboratoryType::where('description', 'LIKE', '%' . $search . '%')
                        ->orderBy($order_by, $sort) 
                        ->paginate($paginate);
        }
        else
        {
            $laboratory_types = LaboratoryType::orderBy($order_by, $sort)->paginate($paginate);
        }

        $description_sort     = $this->link_sort('description', $search, $sort, $request);
        $pagination         = ['search' => $search, 'order_by' => $order_by, 'sort' => $sort];

        //dd($laboratory_types->where('id', 22)); 
        $data = compact('description_sort', 'pagination', 'laboratory_types');
    
        return view('hact.laboratory_type.index', $data);
    }


    public function search(Request $request)
    {
        $search = '%' . trim($request->input('search')) . '%';

        $laboratory_types = LaboratoryType::where('description', 'LIKE', $search)     
                            ->take(30)
                            ->lists('description');

        return response()->json($laboratory_types);
    }

    public function order_by($request)
    {
        if($request->has('order_by'))
        {
            $order_by = trim($request->order_by);

            if($order_by == 'description')
            {
                return 'description';
            }
            else
            {
                return 'description';
            }
        }
        else
        {
            return 'description';
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
            return route('laboratory_type', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort, 'page' => $request->input('page')]);
        }
        else
        {
            return route('laboratory_type', ['search' => $search, 'order_by' => $order_by, 'sort' => $sort]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = route('laboratory_type_store');
        $description = old('desciption');
        $page = 'Create';

        $data = compact('description','action','page');
        return view('hact.laboratory_type.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\LaboratoryTypeStoreRequest $request)
    {
        $input = $request->except(['_token']);
        LaboratoryType::create($input);
        return redirect()->route('laboratory_type_create')->with('status', 'Laboratory type record successfully created.');

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
        $laboratory_type = LaboratoryType::where('id', $id)->first();
        $action = route('laboratory_type_update', $id);
        $description = $laboratory_type->description;
        $page = 'Edit';

        $data = compact('description','action','page');
        return view('hact.laboratory_type.form', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\LaboratoryTypeUpdateRequest $request, $id)
    {
        $input = $request->except(['_token']);
        LaboratoryType::where('id', $id)->update($input);
        return redirect()->route('laboratory_type')->with('status', 'Laboratory type record successfully updated.');
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
