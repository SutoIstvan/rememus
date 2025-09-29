<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Family extends Model
{
    use HasFactory;

    protected $fillable = [
        'memorial_id',
        'name',
        'role',
        'avatar',
        'qr_code',
        'position',
        'node_id',
    ];

    protected $casts = [
        'position' => 'array',
    ];

    /**
     * Получить мемориал, к которому принадлежит этот член семьи
     */
    public function memorial(): BelongsTo
    {
        return $this->belongsTo(Memorial::class);
    }

    /**
     * Доступные роли в семье
     */
    public static function getRoles(): array
    {
        return [
            'main_person' => 'Основное лицо',
            'father' => 'Отец',
            'mother' => 'Мать',
            'grandfather_paternal' => 'Дедушка по отцу',
            'grandmother_paternal' => 'Бабушка по отцу',
            'grandfather_maternal' => 'Дедушка по матери',
            'grandmother_maternal' => 'Бабушка по матери',
            'spouse' => 'Супруг(а)',
            'sibling' => 'Брат/Сестра',
            'child' => 'Ребенок',
        ];
    }

    /**
     * Получить переведенную роль
     */
    public function getRoleNameAttribute(): string
    {
        $roles = self::getRoles();
        return $roles[$this->role] ?? $this->role;
    }
}