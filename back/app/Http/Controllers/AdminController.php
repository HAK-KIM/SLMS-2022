<?php

namespace App\Http\Controllers;
use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function index(){

        $admins = Admin::get();
        return $admins;
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

        // return redirect()->to('/users');
        return [$details];
    }
}
