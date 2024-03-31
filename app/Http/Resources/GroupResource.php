<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{

    public function toArray($request): array
    {
        if (isset($this->id)) {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'description' => $this->description,
                'coins' => $this->coins->map(function ($coin) {
                    return [
                        'id' => $coin->id,
                        'name' => $coin->name,
                        'symbol' => $coin->symbol,
                    ];
                }),
            ];
        }

        return $this->resource;

    }
}
