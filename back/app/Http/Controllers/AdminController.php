<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return Admin::get();
    }
    
    public function login(Request $request) {
        $user = Admin::where('email',"$request->email")->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['sms'=>'invalid']);
        } 
        $token = $user->createToken('cookie')->plainTextToken;
        $cookie = Cookie('jwt',$token,60*24);
        return response()->json(['token'=>$token, 'user'=>$user])
        ->withCookie($cookie);
        
    }
}