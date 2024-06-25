<?php

namespace App\Http\Requests\Rules;

use App\Helpers\Constant;
use App\Helpers\Traits\Balance;
use App\Models\User;
use Closure;
use COM;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class WithdrawAmountCheckRole implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $balance = Balance::available_balance();
        if($value < Constant::MINIMUM_AMOUNT['withdraw']){
            $fail("Invalid amount! Minumum withdraw amount ".Constant::MINIMUM_AMOUNT['withdraw'].' '. Constant::CURRENCY['name'] . ".");
        }
        if($value > $balance){
            $fail("Insufficient Balance! You have ".number_format($balance, 2)." ".Constant::CURRENCY['name']."  in your account.");
        }
    }
}
