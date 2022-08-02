<?php

namespace App\Components\Cities\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CitiesResources extends JsonResource
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
            'id'                => (int) $this->id,
            'name'              => (string) $this->translate($request->header('Api-Lang'))->name ?? '',
        ];
    }
}
