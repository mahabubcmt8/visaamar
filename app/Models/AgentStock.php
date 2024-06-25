<?php

namespace App\Models;

use App\Helpers\Traits\StockTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentStock extends Model
{
    use HasFactory, StockTrait;
    protected static function boot()
    {
        parent::boot();

        static::saved(function ($package) {
            $this->package_stock($package->id, auth()->user()->username, auth()->user()->id);
        });
    }

}
