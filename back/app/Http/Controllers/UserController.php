<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SendEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;


class UserController extends Controller
{
    //
    public function index(){
        return User::with(['leaves'])->get();
    }

    public function register(Request $request){
        $user = new User();
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->bitch = $request->bitch;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->personal_id = $request->personal_id;
        $user->save();
        return response()->json(['sms'=>'Create successfull']);
    }

    public function destroy($id) {
        return User::destroy($id);
    }

    public function store(Request $request) {
        $student = new User();
        $student->firstName=$request->firstName;
        $student->lastName=$request->lastName;
        $student->gender=$request->gender;
        $student->batch=$request->batch;
        $student->email=$request->email;
        $student->password=bcrypt($request->password);
        $student->save();
        return response()->json(["message"=>$student]);
    }
    public function update(Request $request, $id) {
        $student = User::find($id);
        $student->firstName=$request->firstName;
        $student->lastName=$request->lastName;
        $student->gender=$request->gender;
        $student->batch=$request->batch;
        $student->email=$request->email;
        $student->phone=$request->phone;
        $student->save();
        return response()->json(["message"=>$student]);
    }
    //sign up
    public function signUp(Request $request){
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->role=$request->role;
        $user->save();
        $token=$user->createToken('userToken')->plainTextToken;
        $response=[
            'user'=>$user,
            'token'=>$token
        ];
        return response()->json($response);
        return $token;

    }
    //sign out
    public function signOut(Request $request){
        auth()->user()->tokens()->delete();
        return response()->json(['message'=>"Sign out successfuly"]);
    }
    // sign in
    public function signIn(Request $request){
        $request->validate([
            'email'=> ['required','email', 'regex:/(.*)@(student.passerellesnumeriques|passerellesnumeriques)\.org/i'],
            'password'=>'required|min:8',
        ]);
        $user=User::where('email',$request->email)->first();
        return $user->createToken($request->email)->plainTextToken;
        return redirect()->intended('myPassword');

    }


    public function logIn(request $request){
        if(!Auth::attempt($request->only('email','password')))
        {
            return response()->json(['sms'=>'Invalid password'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt', $token, 60*20); //1 day
        return response()->json(['sms'=>'success','token'=>$token],200)->withCookie($cookie);
    }


    public function lognOut(request $request){
        $cookie = Cookie::forget('jwt');
        return response()->json(['sms'=>'Logged out from account'])->withCookie($cookie);
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
