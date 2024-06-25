<?php

namespace App\Http\Requests\Rules;

use App\Helpers\Constant;
use App\Models\User;
use Closure;
use COM;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class CookieCheckRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cookie_id = '';
        if(request()->hasCookie('cookie_id')){
            $cookie_id = request()->cookie('cookie_id');
        }
        if($value != $cookie_id){
            Cookie::queue(Cookie::forget('cookie_id'));
            $fail("Add To Cart Faild! Please Try Again");
        }
    }
}
