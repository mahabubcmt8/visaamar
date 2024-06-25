<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;
    protected  $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function package(){
        return $this->belongsTo(Package::class, 'product_id', 'id');
    }
}
