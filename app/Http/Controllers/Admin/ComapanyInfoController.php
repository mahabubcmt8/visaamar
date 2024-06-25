<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ComapanyInfo;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ComapanyInfoController extends Controller
{
    public function index(){
        $pageTitle = 'Company Information';
        $company_info = ComapanyInfo::findOrFail(1);
        return view('admin.page.company-info', compact('pageTitle', 'company_info'));
    }

    public function logoUpdate(Request $request){

        $data = $request->validate([
            'system_name' => ['required', 'min: 3', 'max:80'],
            'website_logo' => ['nullable', 'mimes:jpg,jpeg,png,gif'],
            'user_logo' => ['nullable', 'mimes:jpg,jpeg,png,gif,svg'],
            'admin_logo' => ['nullable', 'mimes:jpg,jpeg,png,gif,svg'],
            'favicon' => ['nullable', 'mimes:jpg,jpeg,png,gif,svg'],
            'timezone' => ['required'],
        ]);

        $data = ComapanyInfo::findOrFail(1);

        if ($request->hasFIle('website_logo')){
            if($data->website_logo != null){
                $old_img1 = public_path('uploads/system/'.$data->website_logo);
                if (file_exists($old_img1)) {
                    unlink($old_img1);
                }
            }
            $website_logo = $request->file('website_logo');
            $website_logo_name = Str::slug($request->system_name, '-').'-website-logo-'.rand(1,500).'.'.$website_logo->getclientoriginalextension();
            Image::make($website_logo)->save(public_path('uploads/system/'.$website_logo_name));
            $data->website_logo = $website_logo_name;
        }
        if ($request->hasFIle('user_logo')){
            if($data->user_logo != null){
                $old_img2 = public_path('uploads/system/'.$data->user_logo);
                if (file_exists($old_img2)) {
                    unlink($old_img2);
                }
            }
            $user_logo = $request->file('user_logo');
            $user_logo_name = Str::slug($request->system_name, '-').'-user-logo-'.rand(1,500).'.'.$user_logo->getclientoriginalextension();
            Image::make($user_logo)->save(public_path('uploads/system/'.$user_logo_name));
            $data->user_logo = $user_logo_name;
        }
        if ($request->hasFIle('admin_logo')){
            if($data->admin_logo != null){
                $old_img3 = public_path('uploads/system/'.$data->admin_logo);
                if (file_exists($old_img3)) {
                    unlink($old_img3);
                }
            }
            $admin_logo = $request->file('admin_logo');
            $admin_logo_name = Str::slug($request->system_name, '-').'-admin-logo-'.rand(1,500).'.'.$admin_logo->getclientoriginalextension();
            Image::make($admin_logo)->save(public_path('uploads/system/'.$admin_logo_name));
            $data->admin_logo = $admin_logo_name;
        }
        if ($request->hasFIle('favicon')){
            if($data->favicon != null){
                $old_img4 = public_path('uploads/system/'.$data->favicon);
                if (file_exists($old_img4)) {
                    unlink($old_img4);
                }
            }
            $favicon = $request->file('favicon');
            $favicon_name = Str::slug($request->system_name, '-').'-favicon-'.rand(1,500).'.'.$favicon->getclientoriginalextension();
            Image::make($favicon)->save(public_path('uploads/system/'.$favicon_name));
            $data->favicon = $favicon_name;
        }

        $data->system_name = $request->system_name;
        $data->timezone = $request->timezone;
        $data->save();


        flash()->addSuccess('General Setting Updated.');
        return redirect()->back();
    }

    public function companyDetails(Request $request){
        $data = $request->validate([
            'company_name' => ['required', 'min: 3', 'max:260'],
            'site_mettro' => ['required', 'min: 3', 'max:260'],
            'meta_title' => ['required', 'min: 3', 'max:260'],
            'meta_des' => ['nullable', 'min: 3', 'max:260'],
            'meta_keywords' => ['nullable', 'min: 3', 'max:260'],
            'meta_image' => ['nullable', 'mimes:jpg,jpeg,png,gif,svg'],
        ]);
        $data = ComapanyInfo::findOrFail(1);

        if ($request->hasFIle('meta_image')){
            if($data->meta_image != null){
                $old_img4 = public_path('uploads/system/'.$data->meta_image);
                if (file_exists($old_img4)) {
                    unlink($old_img4);
                }
            }
            $meta_image = $request->file('meta_image');
            $meta_image_name = Str::slug($request->company_name, '-').'-meta-image-'.rand(1,500).'.'.$meta_image->getclientoriginalextension();
            Image::make($meta_image)->save(public_path('uploads/system/'.$meta_image_name));
            $data->meta_image = $meta_image_name;
        }
        $data->company_name = $request->company_name;
        $data->site_mettro = $request->site_mettro;
        $data->meta_title = $request->meta_title;
        $data->meta_des = $request->meta_des;
        $data->meta_keywords = $request->meta_keywords;
        $data->save();
        flash()->addSuccess('Company Details Updated.');
        return redirect()->back();
    }

    public function logoRemove(string $field_name){
        $data = ComapanyInfo::findOrFail(1);

        if($data->$field_name != null){
            $old_img1 = public_path('uploads/system/'.$data->$field_name);
            if (file_exists($old_img1)) {
                unlink($old_img1);
            }
        }

        $data->$field_name = null;
        $data->save();

        return response()->json($field_name);
    }
}
