<?php

namespace App\Models\Plan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class Feature extends Model
{
    use HasFactory;


    protected $fillable = [
        'is_active',
        'pos',
        'title',
    ];


    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

}
