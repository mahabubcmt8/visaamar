<?php

namespace App\Http\Controllers;

use App\Helpers\Constant;
use App\Http\Controllers\Controller;
use App\Models\AdsBanner;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{

    public function bannerStore(Request $request)
    {
        $data = $request->validate([
            'img'  => ['required'],
            'url' => ['nullable']
        ]);

        $data = new AdsBanner;
        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $img_name = rand(1, 900) . '-home_banner_section' . rand(1, 500) . '.' . $img->getclientoriginalextension();
            Image::make($img)->save(public_path('uploads/banner-section/' . $img_name));
            $data->img = $img_name;
        }

        $data->url = $request->url;
        // $data->banner = Constant::BANNER_TYPE['banner'];
        $data->save();

        flash()->addSuccess('Banner Section Updated.');
        return redirect()->back();
    }


    public function BannerRemove($id)
    {
        $data = AdsBanner::findOrFail($id);
        if($data->img != null){
            $old_img1 = public_path('uploads/banner-section/'.$data->img);
            if (file_exists($old_img1)) {
                unlink($old_img1);
            }
        }
        $data->forceDelete();
        return back()->with('message', 'banner info delete successfully.');

    }

}
