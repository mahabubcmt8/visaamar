<?php

namespace App\Models;

use App\Helpers\Traits\StockTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Package extends Model
{
    use HasFactory, SoftDeletes, StockTrait;
    protected $guarded = [];

    // public function agent_stock(){
    //     return $this->belongsTo(AgentStock::class, 'package_id');
    // }

}
