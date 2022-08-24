<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\SendEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class UserController extends Controller
{
    public function index() {
        return User::get();
    }

    public function destroy($id) {
        return User::destroy($id);
    }

    public function store(Request $request) {
        $student = new User();
        $student->firstname=$request->firstname;
        $student->lastname=$request->lastname;
        $student->gender=$request->gender;
        $student->batch=$request->batch;
        $student->email=$request->email;
        $student->password=bcrypt($request->password);
        $student->save();
        return response()->json(["message"=>$student]);
    }
    public function update(Request $request, $id) {
        $student = User::find($id);
        $student->firstname=$request->firstname;
        $student->lastname=$request->lastname;
        $student->gender=$request->gender;
        $student->batch=$request->batch;
        $student->email=$request->email;
        $student->save();
        return response()->json(["message"=>$student]);
    }
    //sign up
    public function signUp(Request $request){
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->save();
        $token=$user->createToken('userToken')->plainTextToken;
        $response=[
            'user'=>$user,
            'token'=>$token
        ];
        return response()->json($response);

    }
    //sign out
    public function signOut(Request $request){
        auth()->user()->tokens()->delete();
        return response()->json(['message'=>"Sign out successfuly"]);
    }
    // sign in
    public function signIn(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $user=User::where('email',$request->email)->first();
        return $user->createToken($request->email)->plainTextToken;
        return redirect()->intended('myPassword');

    }

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

        // return redirect()->to('/users');
        return [$details];
    }
}
