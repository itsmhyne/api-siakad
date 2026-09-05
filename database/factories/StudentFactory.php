<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StudentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            // Membuat NIS acak 8 digit
            'nis' => fake()->unique()->numerify('########'), 
            // Membuat UID kartu acak 8 karakter (huruf kapital dan angka)
            'card_uid' => strtoupper(Str::random(8)), 
        ];
    }
}