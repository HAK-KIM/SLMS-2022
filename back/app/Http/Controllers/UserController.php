<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use App\Notifications\SendEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class UserController extends Controller
{
    //
    public function index()
    {
        return User::with(['leaves'])->get();
    }

    public function destroy($id)
    {
        return User::destroy($id);
    }

    public function show($id)
    {
        return User::with('leaves')->findOrfail($id);
    }

    public function store(Request $request)
    {
        $student = new User();
        $student->firstName = $request->firstName;
        $student->lastName = $request->lastName;
        $student->gender = $request->gender;
        $student->batch = $request->batch;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->studentID = $request->studentID;
        $student->password = bcrypt($request->password);
        $student->save();
        return response()->json(["message" => $student]);
    }
    public function update(Request $request, $id)
    {
        $student = User::find($id);
        $student->firstName = $request->firstName;
        $student->lastName = $request->lastName;
        $student->gender = $request->gender;
        $student->batch = $request->batch;
        $student->studentID = $request->studentID;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->save();
        return response()->json(["message" => $student]);
    }

    public function login(Request $request) {
        $user = User::where('email',"$request->email")->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['sms'=>'invalid']);
        } 
        $token = $user->createToken('cookie')->plainTextToken;
        $cookie = Cookie('jwt',$token,60*24);
        return response()->json(['token'=>$token, 'user'=>$user])
        ->withCookie($cookie);
        
    }

    public function logout(Request $request) {
        $cookie = Cookie::forget('jwt');
        return response()->json(['sms'=>'logout'])
            ->withCookie($cookie);
    }

    // Store single user
    public function storeSingleEmail(Request $request, $id)
    {
        $admin = User::find($id);

        $details = array();

        $details['greeting'] = $request->greeting;
        $details['body'] = $request->body;
        $details['actiontext'] = $request->actiontext;
        $details['actionurl'] = $request->actionurl;
        $details['endtext'] = $request->endtext;

        Notification::send($admin, new SendEmailNotification($details));

        return [$details];
    }
}