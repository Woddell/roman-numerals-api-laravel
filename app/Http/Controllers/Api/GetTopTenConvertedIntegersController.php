<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\RomanNumeralConversionResource;
use App\Models\RomanNumeralConversion;

class GetTopTenConvertedIntegersController
{
    public function __invoke()
    {
        $topTenConversions = RomanNumeralConversion::query()
            ->orderByDesc('total_conversions')
            ->limit(10)
            ->get();

        return RomanNumeralConversionResource::collection($topTenConversions);
    }
}
