<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPayment extends Model
{

    protected $fillable = [
        'subscription_id',
        'amount',
        'end_at',
        'payload',
    ];

    protected $casts = [
        'end_at' => 'date',
        'payload' => 'json'
    ];

}
