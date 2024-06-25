<?php

namespace App\Http\Requests\Rules;

use App\Helpers\Constant;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AgentCheckRole implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $regex = '/^[a-zA-Z0-9]+$/';
        if(!preg_match($regex, $value)){
            $fail("Invalid Refer Username. Spaces, dots, and special characters are not allowed.");
        }
        else{
            $user = User::where('username', $value)->where('type', Constant::USER_TYPE['agent'])->where('status', Constant::USER_STATUS['active'])->first();
            if($user == false){
                $fail("Agent User Not Found!");
            }
        }

    }
}
