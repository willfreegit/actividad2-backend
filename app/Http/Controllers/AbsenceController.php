<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use Illuminate\Http\Request;
use App\Utils\ResultResponse;
use Validator;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $absences = Absence::paginate(5);
        $resultResponse = new ResultResponse();
        $resultResponse->setData($absences);
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
        $validator = $this->validateAbsence($request);
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $resultResponse = new ResultResponse();
        try{
            $newAbsence = new Absence(
                [
                    'abs_description'=>$request->get('abs_description'),
                    'abs_referable'=>$request->get('abs_referable')
                ]
                );
            $newAbsence->save();
            $resultResponse->setData($newAbsence);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch(\Exception $ex){
            error_log($ex);
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage($ex);
        }
        return response()->json($resultResponse);
    }

    private function validateAbsence($request){
        $rules = [];
        $messages = [];
        $rules['abs_description']='required|min:5|max:60';
        $messages['abs_description.required'] = 'La descripción de la ausencia es obligatoria';
        $rules['abs_referable']='required';
        $messages['abs_referable.required'] = 'El campo para indicar si es referible es obligatorio';

        return Validator::make($request->all(), $rules, $messages);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function show(Absence $absence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function edit(Absence $absence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validateAbsence($request);
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $resultResponse = new ResultResponse();
        try{
            $absence = Absence::findOrFail($id);
            $absence->abs_description = $request->get('abs_description');
            $absence->abs_referable = $request->get('abs_referable');
    
            $absence->save();
    
            $resultResponse->setData($absence);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setStatusCode(ResultResponse::TXT_SUCCESS_CODE);
        } catch(\Exception $ex){
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setStatusCode(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUND_CODE);
        }
    }

    public function put(Request $request, $id)
    {
        error_log('ingresa a actualizar');
        $resultResponse = new ResultResponse();
        try{
            $absence = Absence::where('abs_id',  $id)->firstOrFail();
            $absence->abs_description = $request->get('abs_description');
            $absence->abs_referable = $request->get('abs_referable');
    
            $absence->save();
    
            $resultResponse->setData($absence);
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
     * @param  \App\Models\Absence  $absence
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resultResponse = new ResultResponse();
        try{
            $absence = Absence::findOrFail($id);
            $absence->delete();
    
            $resultResponse->setData($absence);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setStatusCode(ResultResponse::TXT_SUCCESS_CODE);
        } catch(\Exception $ex){
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setStatusCode(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUND_CODE);
        }
    }
}
