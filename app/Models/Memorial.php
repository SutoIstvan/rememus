<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use App\Models\Image;
use App\Models\Timeline;

class Memorial extends Model
{
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($memorial) {
            if (empty($memorial->slug)) {
                $memorial->slug = $memorial->generateUniqueSlug($memorial->name);
            }
        });
    }

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
        'grave_photo',
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

        // Section toggles
        'family_tree_enabled',
        'gallery_enabled',
        'timeline_enabled',
        'features_enabled',
        'burial_location_enabled',
        'comments_enabled',
    ];

    protected $casts = [
        'characteristics' => 'array',
        'hobbies' => 'array',
        'family_tree_enabled' => 'boolean',
        'gallery_enabled' => 'boolean',
        'timeline_enabled' => 'boolean',
        'features_enabled' => 'boolean',
        'burial_location_enabled' => 'boolean',
        'comments_enabled' => 'boolean',
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
        return self::generateUniqueSlugStatic($name, $this->id);
    }

    // Статический метод — используется в контроллере до создания записи
    public static function generateUniqueSlugStatic(string $name, ?int $excludeId = null): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (true) {
            $query = static::where('slug', $slug);

            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }

            if (!$query->exists()) {
                break;
            }

            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }

    // public function memorialimages()
    // {
    //     return $this->hasMany(Image::class);
    // }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function timeline(): HasMany
    {
        return $this->hasMany(Timeline::class);
    }


    /**
     * Получить членов семьи для этого мемориала
     */


    /**
     * Получить членов семьи для этого мемориала
     */
    public function family(): HasMany
    {
        return $this->hasMany(Family::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(\App\Models\Comment::class);
    }

    /**
     * Получить главное лицо мемориала
     */
    public function mainPerson()
    {
        return $this->family()->where('role', 'main_person')->first();
    }

    /**
     * Получить родителей
     */
    public function parents(): HasMany
    {
        return $this->family()->whereIn('role', ['father', 'mother']);
    }

    /**
     * Получить детей
     */
    public function children(): HasMany
    {
        return $this->family()->where('role', 'child');
    }

    /**
     * Получить супругов
     */
    public function spouses(): HasMany
    {
        return $this->family()->where('role', 'spouse');
    }

    /**
     * Получить братьев и сестер
     */
    public function siblings(): HasMany
    {
        return $this->family()->where('role', 'sibling');
    }

    /**
     * Получить бабушек и дедушек
     */
    public function grandparents(): HasMany
    {
        return $this->family()->whereIn('role', [
            'grandfather_paternal',
            'grandmother_paternal',
            'grandfather_maternal',
            'grandmother_maternal'
        ]);
    }
}
