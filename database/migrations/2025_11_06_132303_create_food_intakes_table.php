<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('food_intakes', function (Blueprint $table) {
            $table->id()->comment('Уникальный идентификатор записи о приеме пищи');

            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade')
                  ->comment('ID пользователя (связь с таблицей users)');

            $table->string('product_photo', 800)
                  ->comment('Фото продукта (путь к файлу)');

            $table->text('product_description')
                  ->nullable()
                  ->comment('Описание продукта');

            $table->integer('total_calories')
                  ->comment('Общая калорийность продукта (ккал)');

            $table->integer('proteins')
                  ->nullable()
                  ->comment('Содержание белков (грамм)');

            $table->integer('fats')
                  ->nullable()
                  ->comment('Содержание жиров (грамм)');

            $table->integer('carbohydrates')
                  ->nullable()
                  ->comment('Содержание углеводов (грамм)');

            $table->timestamps();

            // Индексы для оптимизации запросов
            $table->index('user_id', 'idx_food_intakes_user_id');
            $table->index('created_at', 'idx_food_intakes_created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_intakes');
    }
};
