<?php

namespace Database\Factories;

use App\Models\RomanNumeralConversion;
use App\Services\RomanNumeralConverter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RomanNumeralConversionFactory extends Factory
{
    protected $model = RomanNumeralConversion::class;

    public function definition(): array
    {
        $input = $this->faker->numberBetween(1, 3999);
        return [
            'input' => $input,
            'output' => (new RomanNumeralConverter())->convertInteger($input),
            'last_converted_at' => Carbon::now(),
            'total_conversions' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
