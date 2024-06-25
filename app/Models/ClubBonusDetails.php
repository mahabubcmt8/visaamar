<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClubBonusDetails extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=['name'];

    public function clubBonusDetailsAsset(){

        return $this->hasMany(ClubBonusDetailsAsset::class, 'club_id', 'id');
    }
}
