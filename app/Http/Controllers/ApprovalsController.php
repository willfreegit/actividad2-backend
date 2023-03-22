<?php

namespace App\Http\Controllers;

use App\Models\Approvals;
use Illuminate\Http\Request;
use App\Utils\ResultResponse;
use Validator;

class ApprovalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $approvals = Approvals::paginate(5);
        $resultResponse = new ResultResponse();
        $resultResponse->setData($approvals);
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
        $this->validateApprovals($request);
        $validator = $this->validateApprovals($request);
        if($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }
        $resultResponse = new ResultResponse();
        try{
            $newApprovals = new Approvals(
                [
                    'epl_approval_id'=>$request->get('epl_approval_id'),
                    'aut_sequential_approval_flow'=>$request->get('aut_sequential_approval_flow'),
                    'aut_submission_date_for_approval'=>$request->get('aut_submission_date_for_approval'),
                    'aut_approval_action_date'=>$request->get('epl_aut_approval_action_dateapproval_id'),
                    'aut_action'=>$request->get('aut_action'),
                    'aut_approval_comments'=>$request->get('aut_approval_comments')
                ]
                );
            $newApprovals->save();
            $resultResponse->setData($newApprovals);
            $resultResponse->setStatusCode(ResultResponse::SUCCESS_CODE);
            $resultResponse->setMessage(ResultResponse::TXT_SUCCESS_CODE);
        } catch(\Exception $ex){
            error_log($ex);
            $resultResponse->setStatusCode(ResultResponse::ERROR_CODE);
            $resultResponse->setMessage($ex);
        }
        return response()->json($resultResponse);
    }

    private function validateApprovals($request){
        $rules = [];
        $messages = [];
     /*   $rules['epl_approval_id']='required|exists:employees,epl_id';
        $messages['epl_approval_id.exists'] = 'El empleado no existe';
        $rules['aut_sequential_approval_flow']='required';
        $messages['aut_sequential_approval_flow.required'] =
        'El secuencial aprobación es obligatorio';
        $rules['aut_submission_date_for_approval']='required';
        $messages['aut_submission_date_for_approval.required'] =
        'La fecha de ingreso es obligatoria';
        $rules['aut_action']='required|max:20';
        $messages['aut_action.required'] = 'Accion es obligatoria';
        $messages['aut_action.max'] = 'La accion debe tener como máximo 10 caracteres';*/
        return Validator::make($request->all(), $rules, $messages);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Approvals  $approvals
     * @return \Illuminate\Http\Response
     */
    public function show(Approvals $approvals)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Approvals  $approvals
     * @return \Illuminate\Http\Response
     */
    public function edit(Approvals $approvals)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Approvals  $approvals
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Approvals $approvals)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Approvals  $approvals
     * @return \Illuminate\Http\Response
     */
    public function destroy(Approvals $approvals)
    {
        //
    }
}
