<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'client_firstname' => $this->client_firstname,
            'client_lastname' => $this->client_lastname,
            'client_phone' => $this->client_phone,
            'client_address' => $this->client_address,
            'status' => $this->status,
            'payed' => $this->payed,
            'burger' => new BurgerResource($this->whenLoaded('burger')),  // Add this line
            // 'created_at' => $this->created_at->format('d/m/Y'),
            // 'updated_at' => $this->updated_at->format('d/m/Y'),

        ];
        // return parent::toArray($request);
    }
}
