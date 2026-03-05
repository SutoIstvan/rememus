<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Timeline extends Model
{
    protected $fillable = [
        'memorial_id',
        'title',
        'description',
        'type',
        'location',
        'related_person',
        'media',
        'media_thumb',
        'order',
        'date_from',
        'date_to',
        'date',
    ];

    public function memorial()
    {
        return $this->belongsTo(Memorial::class);
    }
}
