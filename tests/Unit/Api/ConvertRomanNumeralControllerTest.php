<?php

namespace Tests\Unit\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;

class ConvertRomanNumeralControllerTest extends \Tests\TestCase
{

    use RefreshDatabase;

    public function test_it_returns_a_roman_numeral_conversion_resource()
    {
        $response = $this->postJson('/api/roman-numerals', [
            'input' => 1,
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'data' => [
                'input' => 1,
                'output' => 'I',
                'total_conversions' => 1,
            ],
        ]);
    }

    public function test_it_returns_an_existing_roman_numeral_conversion_resource()
    {
        $romanNumeralConversion = \App\Models\RomanNumeralConversion::create([
            'input' => 5,
            'output' => 'V',
            'last_converted_at' => now()->subDay(),
            'total_conversions' => 1,
        ]);

        $response = $this->postJson('/api/roman-numerals', [
            'input' => 5,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'input' => 5,
                'output' => 'V',
                'total_conversions' => 2,
            ],
        ]);
    }
}
