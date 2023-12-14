<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    CONST PLAN_LITE_ID =  1;
    CONST PLAN_BASE_ID =  2;
}
