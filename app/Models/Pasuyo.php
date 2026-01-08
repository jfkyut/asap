<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasuyo extends Model
{
    protected $fillable = [
        'location',
        'full_name',
        'phone',
        'note',
        'content',
        'budget',
        'status',
        'payment_method',
        'user_id',
    ];

    public function attachments()
    {
        return $this->hasMany(PasuyoAttachment::class);
    }

    public function trackings()
    {
        return $this->hasMany(PasuyoTracking::class);
    }
}
