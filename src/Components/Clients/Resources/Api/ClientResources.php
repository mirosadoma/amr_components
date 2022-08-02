<?php

namespace App\Components\Clients\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResources extends JsonResource
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
            'name'              => (string) $this->name,
            'email'             => (string) $this->email,
            'phone'             => (string) $this->phone,
            'active'            => (int) $this->is_active,
            'verification_code' => (string) $this->verification_code ?? "",
            'api_token'         => (string) $this->api_token,
            'image'             => (string) $this->image_path,
            'is_photographer'   => $this->photographer ? (int)  1 : (int)  0
        ];
    }
}
