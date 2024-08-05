<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'remarks',
        'eligibility_for_visa',
        'fees_charges',
        'departure_requiremet',
        'processing_time',
        'flag',
        'contacts_links',
    ];
}
