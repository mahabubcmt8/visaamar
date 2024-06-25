<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank2 extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class,'username', 'username');
    }
    public function rankInfo(){
        return $this->belongsTo(Rank::class,'rank_id', 'id');
    }
}
