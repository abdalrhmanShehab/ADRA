<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\ReciveMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    public function sendEmail(Request $request){
        $data = $request->all();
//        config()->set('MAIL_FROM_ADDRESS',$data['txtEmail']);

//        $details = [
//            'title' => 'Mail from ' . $data['txtName'],
//            'from' =>$data['txtEmail'] ,
//            'body' => $data['txtMsg']
//        ];

        //Config::set('MAIL_FROM_ADDRESS',$data['txtEmail']);


        Mail::send('front.mail',
            array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'subject' => $request->get('subject'),
                'phone_number' => $request->get('phone_number'),
                'user_message' => $request->get('message'),
            ), function($message) use ($request)
            {
                $message->from($request->email);
                $message->to('majdboutros94@gmail.com');
            });

        return "sent";
    }
}
