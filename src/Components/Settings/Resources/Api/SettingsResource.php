<?php

namespace App\Components\Settings\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
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
            'type'              => (string) $this->type,
            'value'             => (string) $this->value,
            'class'             => (string) $this->class,
        ];
    }
}
