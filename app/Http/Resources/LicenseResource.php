<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LicenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "product" => $this->product->name,
            "serial" => $this->serial,
            "platform" => $this->platform,
            "status" => $this->status,
            "price" => $this->product->{"{$this->platform}_price"},
        ];
    }
}
