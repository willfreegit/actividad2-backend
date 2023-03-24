<?php

namespace App\Http\Controllers;

use App\Models\Rules;
use Illuminate\Http\Request;
use App\Utils\ResultResponse;
use Validator;

class RulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rules = Rules::paginate(5);
        $resultResponse = new ResultResponse();
        $resultResponse->setData($rules);
        $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
        $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        return response()->json($resultResponse);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validateRules($request);
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $resultResponse = new ResultResponse();
        try{
            $rules = new Rules(
                [
                    'ben_id'=>$request->get('ben_id'),
                    'rul_min_value_for_calculation'=>$request->get('rul_min_value_for_calculation'),
                    'rul_max_value_for_calculation'=>$request->get('rul_max_value_for_calculation'),
                    'rul_number_of_benefit_days'=>$request->get('rul_number_of_benefit_days'),
                    'rul_sequential_aplicacion_rule'=>$request->get('rul_sequential_aplicacion_rule')
                ]
                );
            $rules->save();
            $resultResponse->setData($rules);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch(\Exception $ex){
            error_log($ex);
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage($ex);
        }
        return response()->json($resultResponse);
    }

    private function validateRules($request){
        $rules = [];
        $messages = [];
        $rules['rul_min_value_for_calculation']='required';
        $messages['rul_min_value_for_calculation.required'] = 'Campo obligatorio';
        $rules['rul_max_value_for_calculation']='required';
        $messages['rul_max_value_for_calculation.required'] = 'Campo obligatorio';
        $rules['rul_number_of_benefit_days']='required';
        $messages['rul_number_of_benefit_days.required'] = 'Campo obligatorio';
        $rules['rul_sequential_aplicacion_rule']='required';
        $messages['rul_sequential_aplicacion_rule.required'] = 'Campo obligatorio';
        $rules['ben_id']='required|exists:benefits,ben_id';
        $messages['ben_id.required'] = 'Campo obligatorio';
        $messages['ben_id.exists'] = 'El empleado no existe';
        return Validator::make($request->all(), $rules, $messages);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rules  $approvals
     * @return \Illuminate\Http\Response
     */
    public function show(Rules $rules)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rules  $approvals
     * @return \Illuminate\Http\Response
     */
    public function edit(Rules $rules)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rules  $approvals
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validateRules($request);
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $resultResponse = new ResultResponse();
        try{
            $rules = Rules::findOrFail($id);
            $rules->ben_id = $request->get('ben_id');
            $rules->rul_min_value_for_calculation = $request->get('rul_min_value_for_calculation');
            $rules->rul_max_value_for_calculation = $request->get('rul_max_value_for_calculation');
            $rules->rul_number_of_benefit_days = $request->get('rul_number_of_benefit_days');
            $rules->rul_sequential_aplicacion_rule = $request->get('rul_sequential_aplicacion_rule');
            $rules->save();
            $resultResponse->setData($rules);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setStatusCode(ResultResponse::TXT_SUCCESS_CODE);
        } catch(\Exception $ex){
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setStatusCode(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUND_CODE);
        }
    }

    public function put(Request $request, $id)
    {
        $validator = $this->validateRules($request);
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $resultResponse = new ResultResponse();
        try{
            $rules = Rules::where('rul_id', $id)->firstOrFail();
            $rules->ben_id = $request->get('ben_id');
            $rules->rul_min_value_for_calculation = $request->get('rul_min_value_for_calculation');
            $rules->rul_max_value_for_calculation = $request->get('rul_max_value_for_calculation');
            $rules->rul_number_of_benefit_days = $request->get('rul_number_of_benefit_days');
            $rules->rul_sequential_aplicacion_rule = $request->get('rul_sequential_aplicacion_rule');
    
            $rules->save();
    
            $resultResponse->setData($rules);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setStatusCode(ResultResponse::TXT_SUCCESS_CODE);
        } catch(\Exception $ex){
            error_log($ex);
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setStatusCode(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUND_CODE);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rules  $absence
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resultResponse = new ResultResponse();
        try{
            $rules = Rules::findOrFail($id);
            $rules->delete();
    
            $resultResponse->setData($rules);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setStatusCode(ResultResponse::TXT_SUCCESS_CODE);
        } catch(\Exception $ex){
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setStatusCode(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUND_CODE);
        }
    }
}
