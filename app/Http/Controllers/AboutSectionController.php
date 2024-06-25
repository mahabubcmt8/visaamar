<?php

namespace App\Http\Controllers;

use App\Models\AboutSection;
use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Http\Request;

class AboutSectionController extends Controller
{
    public function index()
    {
        $pageTitle = 'About Section';
        $data = AboutSection::findOrFail(1);
        return view('admin.about.index', compact('pageTitle', 'data'));
    }
    public function store(Request $request)
    {
        AboutSection::newAbout($request);
        return redirect()->back()->with('message', 'About info create successfully.');

    }



    public function update(Request $request, $id)
    {
        AboutSection::updateAbout($request, $id);
//        $data = AboutSection::findOrFail(1);

        return redirect()->route('admin.settings.about.index')->with('success', 'about info update successfully.');
    }
}
