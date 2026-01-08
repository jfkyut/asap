<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasuyoTracking extends Model
{
    protected $fillable = [
        'pasuyo_id',
        'status_update',
    ];
}
