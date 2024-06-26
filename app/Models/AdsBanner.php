<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdsBanner extends Model
{
    use HasFactory, SoftDeletes;

    public static $banner;
    protected $guarded = [];
}
