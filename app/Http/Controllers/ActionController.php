<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SendMail;

class ActionController extends Controller
{
    public function send(Request $request){
        $formData = $request->all();
        Mail::to('pomah4uk@gmail.com')->send(new SendMail($formData));
        return redirect()->back();
    }
}
