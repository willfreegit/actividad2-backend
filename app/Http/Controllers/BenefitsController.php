<?php

namespace App\Http\Controllers;

use App\Models\Benefits;
use Illuminate\Http\Request;
use App\Utils\ResultResponse;
use Validator;

class BenefitsController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $benefits = Benefits::paginate(5);
        $resultResponse = new ResultResponse();
        $resultResponse->setData($benefits);
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
        $this->validateBenefits($request);
        $validator = $this->validateBenefits($request);
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $resultResponse = new ResultResponse();
        try{
            $newBenefits = new Benefits(
                [
                    'abs_id'=>$request->get('abs_id'),
                    'ben_description'=>$request->get('ben_description'),
                    'ben_referable'=>$request->get('ben_referable')
                ]
                );
            $newBenefits->save();
            $resultResponse->setData($newBenefits);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch(\Exception $ex){
            error_log($ex);
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage($ex);
        }
        return response()->json($resultResponse);
    }

    private function validateBenefits($request){
        $rules = [];
        $messages = [];
        $rules['abs_id']='required|exists:absences,abs_id';
        $messages['abs_id.required'] = 'La auscencia es obligatoria';
        $messages['abs_id.exists'] = 'La auscencia no existe';
        $rules['ben_description']='required|max:60';
        $messages['ben_description.required'] = 'La descripcion es obligatoria';
        $messages['ben_description.max'] = 'El tamaño maximo de la descripcion es 60';
        $rules['ben_referable']='required';
        $messages['ben_referable.required'] = 'El campo referible es obligatorio';
        return Validator::make($request->all(), $rules, $messages);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Benefits  $approvals
     * @return \Illuminate\Http\Response
     */
    public function show(Benefits $benefits)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Benefits  $approvals
     * @return \Illuminate\Http\Response
     */
    public function edit(Benefits $benefits)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Benefits  $approvals
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validateBenefits($request);
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $resultResponse = new ResultResponse();
        try{
            $benefits = Benefits::findOrFail($id);
            $benefits->abs_id = $request->get('abs_id');
            $benefits->ben_description = $request->get('ben_description');
            $benefits->ben_referable = $request->get('ben_referable');
    
            $benefits->save();
    
            $resultResponse->setData($benefits);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setStatusCode(ResultResponse::TXT_SUCCESS_CODE);
        } catch(\Exception $ex){
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setStatusCode(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUND_CODE);
        }
    }

    public function put(Request $request, $id)
    {
        $validator = $this->validateBenefits($request);
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $resultResponse = new ResultResponse();
        try{
            $benefits = Benefits::where('ben_id', $id)->firstOrFail();
            $benefits->abs_id = $request->get('abs_id');
            $benefits->ben_description = $request->get('ben_description');
            $benefits->ben_referable = $request->get('ben_referable');
    
            $benefits->save();
    
            $resultResponse->setData($benefits);
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
     * @param  \App\Models\Benefits  $absence
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resultResponse = new ResultResponse();
        try{
            $benefits = Benefits::findOrFail($id);
            $benefits->delete();
    
            $resultResponse->setData($benefits);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setStatusCode(ResultResponse::TXT_SUCCESS_CODE);
        } catch(\Exception $ex){
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setStatusCode(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUND_CODE);
        }
    }
}
