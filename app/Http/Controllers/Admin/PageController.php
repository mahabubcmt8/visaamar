<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Constant;
use App\Http\Controllers\Controller;
use App\Models\Admin\PageBanner;
use App\Models\AdsBanner;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PageController extends Controller
{
    public function index(){
        $pageTitle = 'Page Banner Config';
        $home_banner = PageBanner::where('type', Constant::BANNER_TYPE['home'])->get();
        $hone_ads_banner = AdsBanner::all();

        return view('admin.page.config.page', compact('pageTitle', 'home_banner', 'hone_ads_banner'));
    }

    public function bannerStore(Request $request){
        $data = $request->validate([
            'img' => ['required'],
            'url' => ['nullable']
        ]);

        $data = new PageBanner;
        if ($request->hasFIle('img')){
            $img = $request->file('img');
            $img_name = rand(1,900).'-homepage-banner-'.rand(1,500).'.'.$img->getclientoriginalextension();
            Image::make($img)->save(public_path('uploads/banner/'.$img_name));
            $data->img = $img_name;
        }

        $data->url = $request->url;
        $data->type = Constant::BANNER_TYPE['home'];
        $data->save();

        flash()->addSuccess('Page Banner Updated.');
        return redirect()->back();
    }

    public function BannerRemove($id, string $class_name){
        $data = PageBanner::findOrFail($id);
        if($data->img != null){
            $old_img1 = public_path('uploads/banner/'.$data->img);
            if (file_exists($old_img1)) {
                unlink($old_img1);
            }
        }
        $data->forceDelete();
        return response()->json($class_name);
    }
}
