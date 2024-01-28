<?php

namespace App\Models\Plan;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_active',
        'pos',
        'title',
        'price_monthly',
        'price_semiannual',
        'price_annual',
    ];

    public function features()
    {
        return $this->hasManyThrough(
            Feature::class,
            PlanFeature::class,
            'plan_id',
            'id',
            'id',
            'feature_id'
        )
            ->orderBy('pos');
    }

    public function activeFeatures()
    {
        return $this->features()->active();
    }

    public function planFeatures()
    {
        return $this->hasMany(PlanFeature::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

}
