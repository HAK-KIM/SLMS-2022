<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Notifications\SendEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

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
    public function storeSingleEmail(Request $request, $id)
    {
        $admin = Admin::find($id);

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