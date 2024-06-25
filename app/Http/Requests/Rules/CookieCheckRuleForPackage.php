<?php

namespace App\Http\Requests\Rules;

use App\Helpers\Constant;
use App\Helpers\Traits\StockTrait;
use App\Models\Cart;
use App\Models\Package;
use App\Models\User;
use Closure;
use COM;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class CookieCheckRuleForPackage implements ValidationRule
{
    use StockTrait;
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cookie_id = '';
        if(request()->hasCookie('package_cookie_id')){
            $cookie_id = request()->cookie('package_cookie_id');
            $cartItems = Cart::where('cookie_id', $cookie_id)->get();
            foreach($cartItems as $cart){
                if($cart->quantity == 0){
                    $fail("You Can Not Purchase Zero Qty.");
                }
                if($this->package_stock($cart->product_id, auth()->user()->username, auth()->user()->id) < $cart->quantity){
                    $fail("Package Stock Is Low! Please Purchase This Package.");
                }
            }
        }
        if($value != $cookie_id){
            Cookie::queue(Cookie::forget('package_cookie_id'));
            $fail("Add To Cart Faild! Please Try Again");
        }
    }
}
