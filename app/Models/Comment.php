<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Comment extends Model
{
    protected $fillable = [
        'name',
        'content',
        'status',
        'memorial_id',
        'photo',
        'photo_thumb',
    ];

    public function memorial(): BelongsTo
    {
        return $this->belongsTo(Memorial::class);
    }

    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo ? Storage::url($this->photo) : null;
    }

    public function getPhotoThumbUrlAttribute(): ?string
    {
        return $this->photo_thumb ? Storage::url($this->photo_thumb) : null;
    }
}
