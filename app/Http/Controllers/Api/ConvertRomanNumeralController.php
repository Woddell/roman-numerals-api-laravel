<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RomanNumeralConversionRequest;
use App\Http\Resources\RomanNumeralConversionResource;
use App\Models\RomanNumeralConversion;
use App\Services\RomanNumeralConverter;

class ConvertRomanNumeralController extends Controller
{
    public function __invoke(RomanNumeralConversionRequest $request, RomanNumeralConverter $romanNumeralConverter)
    {
        $input = $request->input('input');

        $romanNumeralConversion = RomanNumeralConversion::firstOrCreate(
            ['input' => $input],
            [
                'output' => $romanNumeralConverter->convertInteger($input),
                'last_converted_at' => now(),
                'total_conversions' => 1,
            ]
        );
        if ($romanNumeralConversion->wasRecentlyCreated) {
            return new RomanNumeralConversionResource($romanNumeralConversion);
        }

        $romanNumeralConversion->increment('total_conversions');
        $romanNumeralConversion->last_converted_at = now();
        $romanNumeralConversion->save();

        return new RomanNumeralConversionResource($romanNumeralConversion);
    }
}
