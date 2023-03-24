<?php

namespace App\Http\Controllers;

use App\Models\Vacations;
use Illuminate\Http\Request;
use App\Utils\ResultResponse;
use Validator;

class VacationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vacations = Vacations::paginate(5);
        $resultResponse = new ResultResponse();
        $resultResponse->setData($vacations);
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
        $validator = $this->validateVacations($request);
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $resultResponse = new ResultResponse();
        try{
            $vacations = new Vacations(
                [
                    'vac_year'=>$request->get('vac_year'),
                    'vac_year_start_date'=>$request->get('vac_year_start_date'),
                    'vac_year_end_date'=>$request->get('vac_year_end_date'),
                    'vac_taken_days'=>$request->get('vac_taken_days'),
                    'vac_balance_annual_days'=>$request->get('vac_balance_annual_days'),
                    'epl_id'=>$request->get('epl_id')
                ]
                );
            $vacations->save();
            $resultResponse->setData($vacations);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch(\Exception $ex){
            error_log($ex);
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage($ex);
        }
        return response()->json($resultResponse);
    }

    private function validateVacations($request){
        $rules = [];
        $messages = [];
        $rules['vac_year']='required|max:15';
        $messages['vac_year.required'] = 'Campo obligatorio';
        $messages['vac_year.max'] = 'El campo debe tener tamaño maximo 15';
        $rules['vac_year_start_date']='required';
        $messages['vac_year_start_date.required'] = 'Campo obligatorio';
        $rules['vac_year_end_date']='required';
        $messages['vac_year_end_date.required'] = 'Campo obligatorio';
        $rules['vac_taken_days']='required';
        $messages['vac_taken_days.required'] = 'Campo obligatorio';
        $rules['vac_balance_annual_days']='required';
        $messages['vac_balance_annual_days.required'] = 'Campo obligatorio';
        $rules['epl_id']='required|exists:employees,epl_id';
        $messages['epl_id.required'] = 'Campo obligatorio';
        $messages['epl_id.exists'] = 'El empleado no existe';
        return Validator::make($request->all(), $rules, $messages);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vacations  $approvals
     * @return \Illuminate\Http\Response
     */
    public function show(Vacations $vacations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vacations  $approvals
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacations $vacations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vacations  $approvals
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validateVacations($request);
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $resultResponse = new ResultResponse();
        try{
            $vacations = Vacations::findOrFail($id);
            $vacations->vac_year_end_date = $request->get('vac_year_end_date');
            $vacations->vac_year_start_date = $request->get('vac_year_start_date');
            $vacations->vac_year = $request->get('vac_year');
            $vacations->vac_taken_days = $request->get('vac_taken_days');
            $vacations->vac_balance_annual_days = $request->get('vac_balance_annual_days');
            $vacations->epl_id = $request->get('epl_id');
            $vacations->save();
            $resultResponse->setData($vacations);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setStatusCode(ResultResponse::TXT_SUCCESS_CODE);
        } catch(\Exception $ex){
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setStatusCode(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUND_CODE);
        }
    }

    public function put(Request $request, $id)
    {
        $validator = $this->validateVacations($request);
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $resultResponse = new ResultResponse();
        try{
            $vacations = Vacations::where('vac_id', $id)->firstOrFail();
            $vacations->vac_year_end_date = $request->get('vac_year_end_date');
            $vacations->vac_year_start_date = $request->get('vac_year_start_date');
            $vacations->vac_year = $request->get('vac_year');
            $vacations->vac_taken_days = $request->get('vac_taken_days');
            $vacations->vac_balance_annual_days = $request->get('vac_balance_annual_days');
            $vacations->epl_id = $request->get('epl_id');
    
            $vacations->save();
    
            $resultResponse->setData($vacations);
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
     * @param  \App\Models\Vacations  $absence
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resultResponse = new ResultResponse();
        try{
            $vacations = Vacations::findOrFail($id);
            $vacations->delete();
    
            $resultResponse->setData($vacations);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setStatusCode(ResultResponse::TXT_SUCCESS_CODE);
        } catch(\Exception $ex){
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setStatusCode(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUND_CODE);
        }
    }
}
