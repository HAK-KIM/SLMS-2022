<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StudentController extends Controller
{
    

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Student::get();

    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = new Student();
        $student->leave_type = $request->leave_type;
        $student->date_start = $request->date_start;
        $student->end_date = $request->end_date;
        $student->start_time = $request->start_time;
        $student->end_time = $request->end_time;
        $student->reason = $request->reason;
        $student->status = $request->status;
      

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
      

        $student->save();

        return response()->json(['message' => "Student saved successfully"]);
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
        $student = Student::findOrFail($id);
        $student->status = $request->status;

        $student->save();

        return response()->json(['message' => "Student update successfully"]);
    }
}
