<?php

namespace App\Models;

use App\Models\Plan\Plan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SubscriptionSession extends Model
{

    protected $fillable = [
        'period',
        'hash',
        'plan_id',
        'user_id',
        'data',
    ];

    protected $casts = [
        'data' => 'json'
    ];


    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class);
    }

}
