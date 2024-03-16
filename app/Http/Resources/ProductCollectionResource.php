<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollectionResource extends JsonResource
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
            'sku' => $this->sku,
            'name' => $this->name,
            'description' => $this->description,
            'windows_price' => $this->windows_price,
            'mac_price' => $this->mac_price,
            'stock' => [
                'windows' => $this->stock->windows_stock ?? 0,
                'mac' => $this->stock->mac_stock ?? 0,
            ],
        ];
    }
}
