<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * This Class is called with a new instance and constructor on controller, the param is a model.
     * 
     * This resource transform the default response keys into a new keys pattern
     * 
     * Timestamp and underline is ommited. New pattern camelCase is replaced.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'type'       => $this->type,
            'address'    => $this->address,
            'city'       => $this->city,
            'state'      => $this->state,
            'postalCode' => $this->postal_code,
        ];
    }
}
