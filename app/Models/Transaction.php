<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=[
        "admin_id",
        'user_id',
        'agent_id',
        'invoice_id',
        'wallet_type',
        'deb_amount',
        'cred_amount',
        'cred_point',
        'deb_point',
        'status',
        'in_status',
        'transaction_type',
        'transaction_no',
        'transaction_note',
        'method',
        'wallet_address',
        'currency',
        'withdrawal_status',
        'image',
        'date',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
