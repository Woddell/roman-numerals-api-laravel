<?php

namespace Tests\Unit\Api;

use App\Models\RomanNumeralConversion;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetMostRecentConvertedIntegersControllerTest extends \Tests\TestCase
{
    use RefreshDatabase;

    public function test_endpoint_returns_most_recent_converted_integers()
    {
        RomanNumeralConversion::factory()->count(20)->create();
        $response = $this->getJson('api/roman-numerals/most-recent');
        $response->assertStatus(200);
        $response->assertJsonCount(20, 'data');
    }

    public function test_endpoint_returns_most_recent_converted_integers_after_a_given_date()
    {
        RomanNumeralConversion::factory()->count(20)->create();
        // change the last_converted_at date of the first 10 conversions to be 10 days ago, so they are not returned.
        RomanNumeralConversion::query()
            ->limit(10)
            ->get()
            ->each(function (RomanNumeralConversion $conversion) {
                $conversion->last_converted_at = now()->subDays(10);
                $conversion->save();
            });
        $response = $this->getJson('api/roman-numerals/most-recent?converted_after=' . now()->subDay()->toDateString());
        $response->assertStatus(200);
        $response->assertJsonCount(10, 'data');
    }
}
