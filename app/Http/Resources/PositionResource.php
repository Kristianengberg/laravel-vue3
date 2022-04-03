<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PositionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    // Position resource, sender kun navnet på stillingen med
    public function toArray($request)
    {
        return [
            'position_name' => $this->position_name
        ];
    }
}
