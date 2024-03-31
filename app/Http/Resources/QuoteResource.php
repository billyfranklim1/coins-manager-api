<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'coin' => $this->coin->name,
            'timestamp' => $this->timestamp,
            'price_usd' => $this->price_usd,
            'volume_24h' => $this->volume_24h,
            'market_cap' => $this->market_cap,
            'percent_change_24h' => $this->percent_change_24h,
        ];
    }
}
