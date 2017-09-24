<?php
namespace Hact\MedicalAbstract;

use Hact\Repository;
use App\Patient;
use App\ActivityLog;
use Auth;
use Validator;
class MedicalAbstractRepository extends Repository
{
    const LIMIT = 50;

    protected $listener;

    /*public function validation($input, $route, $id){
        $rule   = [
            'date' => 'required|date',
            'body' => 'required|max:1000',
        ];
        $validator      = Validator::make($input, $rule);

        if ($validator->fails()) {
            return redirect()->route($route, [$id, 'error'])->withErrors($validator)->withInput();
        }
    }*/

    public function model()
    {
        $this->user = Auth::user();
        return "App\\MedicalAbstract";
    }

    public function create($id)
    {
        $data['patient_id'] = $id;
        $data['search_patient'] = Patient::find($id)->code_name;
        $data['date'] = old('date');
        $data['body'] = old('body');
        $data['action'] = route('medical_abstract_store');
        $data['action_name'] = 'Create';

        return $data;
    }

    public function setListener($listener){
        $this->listener = $listener;
    }



    public function store($input, $request){
        //$this->validation($input,'medical_abstract_create',$request->patient_id);
        $rule   = [
            'date' => 'required|date',
            'body' => 'required|max:1000',
        ];
        $validator      = Validator::make($input, $rule);

        if ($validator->fails()) {
            //return redirect()->route('medical_abstract_create', $request->patient_id)->withErrors($validator)->withInput();
            return $this->listener->createFail($validator, $request->patient_id);
        }
        $medical_abstract = $this->model->create($input);

        ActivityLog::create([
            'page' => 'Medical Abstract',
            'message' =>'Medical Abstract for '.$medical_abstract->Patient->code_name . ' has been created!',
            'user_id' => Auth::user()->id
        ]);

        return $this->listener->createPassed($request->patient_id);
        //return $request->patient_id;
    }

    public function edit($id)
    {
        $data = $this->model->find($id);
        $data['search_patient'] = Patient::find($id)->code_name;
        $data['action'] = route('medical_abstract_update', $id);
        $data['action_name'] = 'Edit';
        $old = old();
        foreach($data as $key => $value)
        {
            $data[$key] = (isset($old[$key]))?$old[$key]:$value;
        }



        return $data;

    }

    public function update($input, $request, $id)
    {
        //$this->validation($input,'medical_abstract_edit',$id);
        $rule   = [
            'date' => 'required|date',
            'body' => 'required|max:1000',
        ];
        $validator      = Validator::make($input, $rule);

        if ($validator->fails()) {
            //return redirect()->route('medical_abstract_create', $request->patient_id)->withErrors($validator)->withInput();
            return $this->listener->updateFail($validator, $id);
        }
        $this->model->find($id)->update($input);

        ActivityLog::create([
            'page' => 'Medical Abstract',
            'message' =>'Medical Abstract for '.$this->model->find($id)->Patient->code_name . ' has been updated!',
            'user_id' => Auth::user()->id
        ]);

        return $this->listener->updatePassed($id);
    }

    public function destroy($id)
    {
        $patient_id = $this->model->find($id)->patient_id;

        ActivityLog::create([
            'page' => 'Medical Abstract',
            'message' =>'Medical Abstract for '.$this->model->find($id)->Patient->code_name . ' has been deleted!',
            'user_id' => Auth::user()->id
        ]);

        $this->model->find($id)->delete();
        return $patient_id;
    }

    public function print_medical_abstract($id){
        return $this->model->find($id);
    }

    public function search($search)
    {

    }

    public function find($id)
    {

    }


}
