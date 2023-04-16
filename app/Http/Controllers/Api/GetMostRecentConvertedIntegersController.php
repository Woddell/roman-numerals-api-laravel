<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\RomanNumeralConversionResource;
use App\Models\RomanNumeralConversion;
use Illuminate\Http\Request;

class GetMostRecentConvertedIntegersController
{
    public function __invoke(Request $request)
    {
        $data = $request->validate(
            [
                'converted_after' => 'nullable|date'
            ]
        );
        $mostRecentConversions = RomanNumeralConversion::query()
            ->orderByDesc('last_converted_at')
            ->where('last_converted_at', '>=', $data['converted_after'] ?? now()->subDay())
            ->paginate(20);
        return RomanNumeralConversionResource::collection($mostRecentConversions);
    }
}
