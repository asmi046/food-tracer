<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Получить все записи о приеме пищи пользователя.
     */
    public function foodIntakes(): HasMany
    {
        return $this->hasMany(FoodIntake::class);
    }

    /**
     * Получить записи о приеме пищи за сегодня.
     */
    public function todayFoodIntakes(): HasMany
    {
        return $this->hasMany(FoodIntake::class)
                    ->whereDate('created_at', today());
    }

    /**
     * Получить общую калорийность за сегодня.
     */
    public function getTodayTotalCaloriesAttribute(): int
    {
        return $this->todayFoodIntakes()
                    ->sum('total_calories');
    }

    /**
     * Получить общую питательную ценность за сегодня.
     */
    public function getTodayNutritionalInfoAttribute(): array
    {
        $todayIntakes = $this->todayFoodIntakes()->get();
        
        return [
            'calories' => $todayIntakes->sum('total_calories'),
            'proteins' => $todayIntakes->sum('proteins'),
            'fats' => $todayIntakes->sum('fats'),
            'carbohydrates' => $todayIntakes->sum('carbohydrates'),
        ];
    }
}
