<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SendEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request)
    {
        $student = new User();
        $student->firstName = $request->firstName;
        $student->lastName = $request->lastName;
        $student->gender = $request->gender;
        $student->batch = $request->batch;
        $student->email = $request->email;
        $student->phone = $request->phone;
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
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->save();
        return response()->json(["message" => $student]);
    }

    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'errors' => $validate->errors()
            ], 422);
        }
        $reqData = request()->only('email', 'password');

        if (Auth::attempt($reqData)) {
            $user = Auth::user();
            $data['token_type'] =  'Bearer';
            $token = $user->createToken('token')->accessToken;
            $data['user'] = $user;
            $cookie = Cookie('cookie',$token,60*24);            
            return response()->json(['token' => $token, 'user' => $user], 200)
                ->withCookie($cookie);
        } else {

            return response()->json([
                'loginFailed' => 'Email or Password Incorrect'
            ], 401);
        }
    }

    public function logout()
    {
        $cookie = Cookie::forget('cookie');
        return response()->json(['sms' => 'logout'])
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

        // return redirect()->to('/users');
        return [$details];
    }
}
