<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClubBonusDetailsAsset extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=['club_id', 'rank_id', 'bonus'];

    public function rank()
    {
        return $this->belongsTo(Rank::class, 'rank_id', 'id');
    }

}
