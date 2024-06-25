<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\DemoMail;

class SendMailController extends Controller
{
    public function index()
    {
        $sendMail = [
            'name' => 'Hello World',
            'email'  => 'Thsi is for testing',
            'phone'  => 'Thsi is for testing',
            'message'  => 'Thsi is for testing',
        ];

        // Mail::to('sadikaafrin170043@gmail.com')->send(new DemoMail($sendMail));

    }
}
