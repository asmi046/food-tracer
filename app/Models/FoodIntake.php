<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FoodIntake extends Model
{
    use HasFactory;

    /**
     * Атрибуты, которые можно массово присваивать.
     */
    protected $fillable = [
        'user_id',
        'product_photo',
        'product_description',
        'total_calories',
        'proteins',
        'fats',
        'carbohydrates',
    ];

    /**
     * Типы данных для атрибутов.
     */
    protected $casts = [
        'total_calories' => 'integer',
        'proteins' => 'integer',
        'fats' => 'integer',
        'carbohydrates' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Связь с пользователем.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Получить URL фото продукта.
     */
    public function getPhotoUrlAttribute(): string
    {
        return asset('storage/' . $this->product_photo);
    }

    /**
     * Получить общую питательную ценность продукта.
     */
    public function getNutritionalInfoAttribute(): array
    {
        return [
            'calories' => $this->total_calories,
            'proteins' => $this->proteins ?? 0,
            'fats' => $this->fats ?? 0,
            'carbohydrates' => $this->carbohydrates ?? 0,
        ];
    }

    /**
     * Скоп для получения записей конкретного пользователя.
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Скоп для получения записей за определенную дату.
     */
    public function scopeForDate($query, $date)
    {
        return $query->whereDate('created_at', $date);
    }

    /**
     * Скоп для получения записей за период.
     */
    public function scopeForPeriod($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }
}
