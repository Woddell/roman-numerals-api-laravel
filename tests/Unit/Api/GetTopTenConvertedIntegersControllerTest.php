<?php

namespace Tests\Unit\Api;

use App\Models\RomanNumeralConversion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetTopTenConvertedIntegersControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_endpoint_returns_top_ten_converted_integers()
    {
        RomanNumeralConversion::factory()->count(20)->create();
        $response = $this->getJson('api/roman-numerals/top-ten');

        $response->assertStatus(200);
        $response->assertJsonCount(10, 'data');

        $topTenConversions = RomanNumeralConversion::query()
            ->orderByDesc('total_conversions')
            ->limit(10)
            ->get();
        $response->assertJson([
            'data' => $topTenConversions->map(fn($conversion) => [
                'output' => $conversion->output,
                'input' => $conversion->input,
                'total_conversions' => $conversion->total_conversions,
            ])->toArray(),
        ]);
    }
}
