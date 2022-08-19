<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LeaveRequestController extends Controller
{
    

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return LeaveRequest::get();

    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $LeaveRequest = new LeaveRequest();
        $LeaveRequest->leave_type = $request->leave_type;
        $LeaveRequest->date_start = $request->date_start;
        $LeaveRequest->end_date = $request->end_date;
        $LeaveRequest->start_time = $request->start_time;
        $LeaveRequest->end_time = $request->end_time;
        $LeaveRequest->reason = $request->reason;
        $LeaveRequest->duration = $request->duration;
        $LeaveRequest->status = $request->status;
      

        $validated = $request->validate(
            [
            'leave_type' => 'string|required',
            'date_start' => 'string|required',
            'end_date' => 'string|required',
            'start_time' => 'string|required',
            'end_time' => 'string|required',
            ],
            [                
                    'leave_type.required' => 'leave_type is required',                 
                    'date_start.required' => 'date_start is required',                  
                    'end_date.required' => 'end_date is required', 
                    'start_time.required' => 'start_time is required', 
                    'end_time.required' => 'end_time is required', 
            ]
    );
      

        $LeaveRequest->save();

        return response()->json(['message' => "LeaveRequest saved successfully"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $LeaveRequest = LeaveRequest::findOrFail($id);
        $LeaveRequest->status = $request->status;

        $LeaveRequest->save();

        return response()->json(['message' => "LeaveRequest update successfully"]);
    }
}
