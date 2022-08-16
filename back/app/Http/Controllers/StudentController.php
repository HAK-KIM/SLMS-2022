<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use Illuminate\Http\Request;

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
        $student->end_start = $request->end_start;
        $student->status = $request->status;
      

        $validated = $request->validate(
            [
            'leave_type' => 'string|required',
            'date_start' => 'string|required',
            'end_start' => 'string|required',
            'status' => 'boolean|required',
            ],
            [                
                    'leave_type.required' => 'leave_type is required',                 
                    'date_start.required' => 'date_start is required',                  
                    'end_start.required' => 'end_start is required', 
                    'status.required' => 'status is required', 
            ]
    );
      

        $student->save();

        return response()->json(['message' => "Student saved successfully"]);
    }
}
