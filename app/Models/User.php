<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Helpers\Constant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'phone',
        'refer',
        'agent',
        'email',
        'image',
        'nid_no',
        'gender',
        'birthday',
        'country',
        'states',
        'password',
        'show_password',
        'status',
        'type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function referrals(){
        return $this->hasMany(User::class, 'refer', 'username')->where('status', Constant::USER_STATUS['active'])->with('purchase');
    }

    public function refferrer(){
        return $this->belongsTo(User::class,'refer','username');
    }
    public function referralsRecursive()
    {
        return $this->referrals()->with('referralsRecursive')->limit(10);
    }

    public function purchase(){
        return $this->hasMany(Transaction::class, 'user_id', 'id')
        ->where(function ($query) {
            $query->whereIn('transaction_type', [Constant::TRANSACTION_TYPE['product_sell'], Constant::TRANSACTION_TYPE['package_sell']]);
        });
    }
    public function rank(){
        return $this->hasOne(Rank2::class,'username', 'username')->latest();
    }
    public function countryInfo(){
        return $this->belongsTo(Country::class,'country','id');
    }
}
