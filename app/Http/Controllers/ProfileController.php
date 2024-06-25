<?php

namespace App\Http\Controllers;

use App\Helpers\Constant;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Share;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(){
        $pageTitle = "My Profile";
        $user = Auth::user();
        $shareBtn = Share::page(route('login').'?refer='.$user->username)
                    ->facebook()
                    ->telegram()
                    ->whatsapp()
                    ->getRawLinks();
                    
        if($user->type == Constant::USER_TYPE['agent']){
            return view('user.page.profile.index', compact('pageTitle', 'user', 'shareBtn'));
        }
        else{
            return view('customer.page.profile.index', compact('pageTitle', 'user', 'shareBtn'));
        }
    }
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'phone' => ['required', 'numeric'],
            'image' => ['nullable', 'mimes:jpeg,jpg,png'],
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->hasFIle('image')){

            if($user->image != null){
                $old_img = public_path('uploads/user/profile/'.$user->image);
                if (file_exists($old_img)) {
                    unlink($old_img);
                }
            }

            $image = $request->file('image');
            $file_name = $user->username.rand(100,900).'.'.$image->getclientoriginalextension();

            Image::make($image)->resize(270, 270)->save(public_path('uploads/user/profile/'.$file_name));

            $user->image = $file_name;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile Updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
