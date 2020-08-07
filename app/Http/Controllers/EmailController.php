<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Utils\SendMail;

class EmailController extends Controller
{
 
    public function sendEmail(){
        
        $message = request('message');
        $emailRestaurant = request('email');

        $title = '[Confirmation] Thank you for your order';
      
        $sendmail = Mail::to($emailRestaurant)->send(new SendMail($title, $message));
        if (empty($sendmail)) {
            return response()->json(['message' => 'Mail Sent Sucssfully'], 200);
        }else{
            return response()->json(['message' => 'Mail Sent fail'], 400);
        }
        
    }

}
