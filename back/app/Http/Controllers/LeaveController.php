<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\Leave;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LeaveController extends Controller
{
    

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Leave::get();

    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Leave = new Leave();
        $Leave->leave_type = $request->leave_type;
        $Leave->date_start = $request->date_start;
        $Leave->end_date = $request->end_date;
        $Leave->start_time = $request->start_time;
        $Leave->end_time = $request->end_time;
        $Leave->reason = $request->reason;
        $Leave->duration = $request->duration;
        $Leave->status = $request->status;
      

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
      

        $Leave->save();

        return response()->json(['message' => "Leave saved successfully"]);
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
        $Leave = Leave::findOrFail($id);
        $Leave->status = $request->status;

        $Leave->save();

        return response()->json(['message' => "Leave update successfully"]);
    }
}
