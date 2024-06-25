<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $pageTitle = 'Contact Section';
        $data = Contact::findOrFail(1);
        return view('admin.contact.index', compact('pageTitle', 'data'));
    }
    public function store(Request $request)
    {
        Contact::newContact($request);
        return redirect()->back()->with('success', 'Contact info create successfully.');

    }



    public function update(Request $request, $id)
    {
        Contact::updateContact($request, $id);
//        $data = AboutSection::findOrFail(1);

        return redirect()->route('admin.settings.contact.index')->with('success', 'contact info update successfully.');
    }
}
