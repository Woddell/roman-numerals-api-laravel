<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\RomanNumeralConversion */
class RomanNumeralConversionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'input' => $this->input,
            'output' => $this->output,
            'last_converted_at' => $this->last_converted_at,
            'total_conversions' => $this->total_conversions,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
