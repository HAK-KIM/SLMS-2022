<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
}
