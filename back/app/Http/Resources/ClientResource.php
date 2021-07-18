<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'lastname' => $this->lastname,
            'phone' => $this->phone,
            'dni' => $this->dni,
            'addresses' => AddressResource::collection($this->whenLoaded('addresses')),
        ];
    }
}
