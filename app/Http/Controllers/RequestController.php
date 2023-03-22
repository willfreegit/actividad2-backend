<?php

namespace App\Http\Controllers;

use App\Models\Requests;
use Illuminate\Http\Request;
use App\Utils\ResultResponse;
use Validator;

class RequestController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requestes = Requests::paginate(5);
        $resultResponse = new ResultResponse();
        $resultResponse->setData($requestes);
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
        $validator = $this->validateRequestes($request);
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $resultResponse = new ResultResponse();
        try{
            $newRequest = new Requests(
                [
                    'epl_id'=>$request->get('epl_id'),
                    'abs_id'=>$request->get('abs_id'),
                    'req_entry_request_date'=>$request->get('req_entry_request_date'),
                    'req_status'=>$request->get('req_status'),
                    'req_absence_start_date'=>$request->get('req_absence_start_date'),
                    'req_absence_end_date'=>$request->get('req_absence_end_date'),
                    'req_days_requested'=>$request->get('req_days_requested'),
                    'req_comments'=>$request->get('req_comments')
                ]
                );
            $newRequest->save();
            $resultResponse->setData($newRequest);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch(\Exception $ex){
            error_log($ex);
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage($ex);
        }
        return response()->json($resultResponse);
    }

    private function validateRequestes($request){
        $rules = [];
        $messages = [];
        $rules['req_entry_request_date']='required';
        $messages['req_entry_request_date.required'] = 'La fecha de solicitud es obligatoria';

        $rules['req_status']='required|max:10';
        $messages['req_status.required'] = 'El estatus es obligatorio';
        $messages['req_status.max'] = 'El estatus debe ser maximo de 10 caracteres';

        $rules['req_absence_start_date']='required';
        $messages['epl_lastname.required'] = 'La fecha de inicio es obligatorio';

        $rules['req_absence_end_date']='required';
        $messages['epl_DOB.required'] = 'La fecha de fin debe ser obligatoria';

        $rules['req_days_requested']='required';
        $messages['epl_document_type.required'] = 'El numero de dias es obligatorio';

        $rules['req_comments']='required';
        $messages['epl_employee_status.required'] = 'El comentario es obligatorio';

        $rules['epl_id']='required|exists:employees,epl_id';
        $messages['epl_id.required'] = 'El empleado es obligatorio';
        $messages['epl_id.exists'] = 'El empleado no existe';

        $rules['abs_id']='required|exists:absences,abs_id';
        $messages['abs_id.required'] = 'La ausencia es obligatoria';
        $messages['abs_id.exists'] = 'La ausencia no existe';
        return Validator::make($request->all(), $rules, $messages);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Requests  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Requests  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Requests $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Requests  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validateRequestes($request);
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $resultResponse = new ResultResponse();
        try{
            $requests = Requests::findOrFail($id);
            $requests->epl_id = $request->get('epl_id');
            $requests->abs_id = $request->get('abs_id');
            $requests->req_entry_request_date = $request->get('req_entry_request_date');
            $requests->req_status = $request->get('req_status');
            $requests->req_absence_start_date = $request->get('req_absence_start_date');
            $requests->req_absence_end_date = $request->get('req_absence_end_date');
            $requests->req_days_requested = $request->get('req_days_requested');
            $requests->req_comments = $request->get('req_comments');
            $requests->save();
    
            $resultResponse->setData($requests);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setStatusCode(ResultResponse::TXT_SUCCESS_CODE);
        } catch(\Exception $ex){
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setStatusCode(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUND_CODE);
        }
    }

    public function put(Request $request, $id)
    {
        $validator = $this->validateRequestes($request);
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $resultResponse = new ResultResponse();
        try{
            $requests = Requests::where('req_id',  $id)->firstOrFail();
            $requests->epl_id = $request->get('epl_id');
            $requests->abs_id = $request->get('abs_id');
            $requests->req_entry_request_date = $request->get('req_entry_request_date');
            $requests->req_status = $request->get('req_status');
            $requests->req_absence_start_date = $request->get('req_absence_start_date');
            $requests->req_absence_end_date = $request->get('req_absence_end_date');
            $requests->req_days_requested = $request->get('req_days_requested');
            $requests->req_comments = $request->get('req_comments');
    
            $requests->save();
    
            $resultResponse->setData($requests);
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
     * @param  \App\Models\Employee  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $resultResponse = new ResultResponse();
        try{
            $requests = Requests::findOrFail($id);
            $requests->delete();
    
            $resultResponse->setData($requests);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setStatusCode(ResultResponse::TXT_SUCCESS_CODE);
        } catch(\Exception $ex){
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setStatusCode(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUND_CODE);
        }
    }
}
