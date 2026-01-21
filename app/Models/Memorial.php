<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Memorial extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'slug',
        'name',
        'birth_date',
        'death_date',
        'photo',
        'background_image',
        'video_thumbnail',
        'video',
        'biography',
        'motto',
        'private',
        'coordinates',
        'theme',
        'comments',
        'gift',
        'qr_code',
        'birth_place',
        'grave_location',
        'grave_coordinates',
        'grave_parcel',
        'grave_line',
        'grave_number',
        'virtual_code',
        'admin_id',
        'generation_attempts_left',

        'characteristics',
        'custom_traits',
        'hobbies',
        'additional_hobbies',
        'retirement',
        'habits',
        'stories',
        'wisdom',
    ];

    protected $casts = [
        'characteristics' => 'array',
        'hobbies' => 'array',
    ];

    // Указываем, что для маршрутов используется slug
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Разрешение маршрута: поиск по slug или id
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('slug', $value)
            ->orWhere('id', $value)
            ->firstOrFail();
    }

    // Генерация уникального slug
    protected function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (static::where('slug', $slug)->where('id', '!=', $this->id)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }

    // public function memorialimages()
    // {
    //     return $this->hasMany(Image::class);
    // }

    // public function images()
    // {
    //     return $this->hasMany(Image::class);
    // }

    // public function comments()
    // {
    //     return $this->hasMany(Comment::class);
    // }

    // public function timelines()
    // {
    //     return $this->hasMany(Timeline::class);
    // }

    // public function family()
    // {
    //     return $this->hasMany(Family::class);
    // }

    // public function timeline()
    // {
    //     return $this->hasMany(Timeline::class);
    // }


    /**
     * Получить членов семьи для этого мемориала
     */
    public function families(): HasMany
    {
        return $this->hasMany(Family::class);
    }

    /**
     * Получить главное лицо мемориала
     */
    public function mainPerson()
    {
        return $this->families()->where('role', 'main_person')->first();
    }

    /**
     * Получить родителей
     */
    public function parents(): HasMany
    {
        return $this->families()->whereIn('role', ['father', 'mother']);
    }

    /**
     * Получить детей
     */
    public function children(): HasMany
    {
        return $this->families()->where('role', 'child');
    }

    /**
     * Получить супругов
     */
    public function spouses(): HasMany
    {
        return $this->families()->where('role', 'spouse');
    }

    /**
     * Получить братьев и сестер
     */
    public function siblings(): HasMany
    {
        return $this->families()->where('role', 'sibling');
    }

    /**
     * Получить бабушек и дедушек
     */
    public function grandparents(): HasMany
    {
        return $this->families()->whereIn('role', [
            'grandfather_paternal',
            'grandmother_paternal',
            'grandfather_maternal',
            'grandmother_maternal'
        ]);
    }
}
