<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProviderResource extends JsonResource
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
            'balance' => $this->parentAmount,
            'currency' => $this->Currency,
            'email' => $this->parentEmail,
            'status' => $this->statusCode,
            'created_at' => $this->registerationDate,
            'id' => $this->parentIdentification,
        ];
    }
}