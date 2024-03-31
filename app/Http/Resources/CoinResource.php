<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CoinResource extends JsonResource
{

    public function toArray($request): array
    {
        if (isset($this->id)) {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'symbol' => $this->symbol,
            ];
        }

        return $this->resource;

    }
}
