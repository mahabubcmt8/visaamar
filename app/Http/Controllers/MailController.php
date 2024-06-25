<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\DemoMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
        $mailData = [
            'title' => 'Hello World',
            'body'  => 'Thsi is for testing',
        ];

        Mail::to('propertysllr@gmail.com')->send(new DemoMail($mailData));

    }

    public function store(Request $request)
    {
        $mailData = [
            'name' => $request->name,
            'email'  => $request->phone,
            'phone'  => $request->email,
            'message'  => $request->message,
        ];

        Mail::to('propertysllr@gmail.com')->send(new DemoMail($mailData));
        return redirect()->back()->with('success', 'Mail Sended Successfully Done.');

    }
}
