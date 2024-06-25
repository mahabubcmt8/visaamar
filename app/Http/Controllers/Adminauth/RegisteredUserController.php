<?php

namespace App\Http\Controllers\Adminauth;

use App\Helpers\Constant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rules\AgentCheckRole;
use App\Http\Requests\Rules\ReferCheckRole;
use App\Http\Requests\Rules\UsernameCheckRole;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // public function store(Request $request): RedirectResponse
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:60', 'unique:'.User::class, new UsernameCheckRole],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'phone' => ['required', 'numeric'],
            'refer' => ['required', 'string', 'max:60', new ReferCheckRole],
            'agent' => ['required', 'string', 'max:60', new AgentCheckRole],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);


        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
            'refer' => $request->refer,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'show_password' => $request->password,
            'status' => Constant::USER_STATUS['active'],
            'type' => Constant::USER_TYPE['user']
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
