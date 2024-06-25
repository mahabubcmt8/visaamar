<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leadership extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function rank(){
        return $this->belongsTo(Rank::class, 'rank_id', 'id');
    }
}
