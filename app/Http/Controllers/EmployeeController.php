<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Utils\ResultResponse;
use Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::paginate(5);
        $resultResponse = new ResultResponse();
        $resultResponse->setData($employees);
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
        $validator = $this->validateEmployee($request);
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $resultResponse = new ResultResponse();
        try{
            $newEmployee = new Employee(
                [
                    'epl_identity_document'=>$request->get('epl_identity_document'),
                    'epl_name'=>$request->get('epl_name'),
                    'epl_lastname'=>$request->get('epl_lastname'),
                    'epl_DOB'=>$request->get('epl_DOB'),
                    'epl_document_type'=>$request->get('epl_document_type'),
                    'epl_email'=>$request->get('epl_email'),
                    'epl_last_entry_date'=>$request->get('epl_last_entry_date'),
                    'epl_last_exit_date'=>$request->get('epl_last_exit_date'),
                    'epl_employee_status'=>$request->get('epl_employee_status'),
                    'dep_id'=>$request->get('dep_id')
                ]
                );
            $newEmployee->save();
            $resultResponse->setData($newEmployee);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch(\Exception $ex){
            error_log($ex);
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage($ex);
        }
        return response()->json($resultResponse);
    }

    private function validateEmployee($request){
        $rules = [];
        $messages = [];
        $rules['epl_identity_document']='required|max:15';
        $messages['epl_identity_document.required'] = 'El documento de identidad es obligatorio';
        $messages['epl_identity_document.max'] = 'El documento de identidad debe ser maximo de 15 caracteres';

        $rules['epl_name']='required|max:60';
        $messages['epl_name.required'] = 'El nombre es obligatorio';
        $messages['epl_name.max'] = 'El nombre debe ser maximo de 60 caracteres';

        $rules['epl_lastname']='required|max:60';
        $messages['epl_lastname.required'] = 'El apellido es obligatorio';
        $messages['epl_lastname.max'] = 'El apellido debe ser maximo de 60 caracteres';

        $rules['epl_DOB']='required';
        $messages['epl_DOB.required'] = 'La fecha de nacimiento debe ser obligatoria';

        $rules['epl_document_type']='required|max:1';
        $messages['epl_document_type.required'] = 'El tipo de documento es obligatorio';
        $messages['epl_document_type.max'] = 'El tipo de documento debe ser de 1 solo caracter';

        $rules['epl_employee_status']='required|max:8';
        $messages['epl_employee_status.required'] = 'El estatus es obligatorio';
        $messages['epl_employee_status.max'] = 'El estatus del empleado debe ser de maximo 8 caracteres';

        $rules['dep_id']='required|exists:departments,dep_id';
        $messages['dep_id.required'] = 'El departamento es obligatorio';
        $messages['dep_id.exists'] = 'El departamento no existe';
        return Validator::make($request->all(), $rules, $messages);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validateEmployee($request);
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $resultResponse = new ResultResponse();
        try{
            $employee = Employee::findOrFail($id);
            $employee->epl_identity_document = $request->get('epl_identity_document');
            $employee->epl_name = $request->get('epl_name');
            $employee->epl_lastname = $request->get('epl_lastname');
            $employee->epl_DOB = $request->get('epl_DOB');
            $employee->epl_document_type = $request->get('epl_document_type');
            $employee->epl_email = $request->get('epl_email');
            $employee->epl_last_entry_date = $request->get('epl_last_entry_date');
            $employee->epl_last_exit_date = $request->get('epl_last_exit_date');
            $employee->epl_employee_status = $request->get('epl_employee_status');
            $employee->dep_id = $request->get('dep_id');
            $employee->save();
    
            $resultResponse->setData($employee);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setStatusCode(ResultResponse::TXT_SUCCESS_CODE);
        } catch(\Exception $ex){
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setStatusCode(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUND_CODE);
        }
    }

    public function put(Request $request, $id)
    {
        $resultResponse = new ResultResponse();
        try{
            $employee = Employee::where('epl_id',  $id)->firstOrFail();
            $employee->epl_identity_document = $request->get('epl_identity_document');
            $employee->epl_name = $request->get('epl_name');
            $employee->epl_lastname = $request->get('epl_lastname');
            $employee->epl_DOB = $request->get('epl_DOB');
            $employee->epl_document_type = $request->get('epl_document_type');
            $employee->epl_email = $request->get('epl_email');
            $employee->epl_last_entry_date = $request->get('epl_last_entry_date');
            $employee->epl_last_exit_date = $request->get('epl_last_exit_date');
            $employee->epl_employee_status = $request->get('epl_employee_status');
            $employee->dep_id = $request->get('dep_id');;
    
            $employee->save();
    
            $resultResponse->setData($employee);
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
            $employee = Employee::findOrFail($id);
            $employee->delete();
    
            $resultResponse->setData($employee);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setStatusCode(ResultResponse::TXT_SUCCESS_CODE);
        } catch(\Exception $ex){
            $resultResponse->setStatusCode(ResultResponse::ERROR_ELEMENT_NOT_FOUND_CODE);
            $resultResponse->setStatusCode(ResultResponse::TXT_ERROR_ELEMENT_NOT_FOUND_CODE);
        }
    }
}
