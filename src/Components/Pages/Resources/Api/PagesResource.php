<?php

namespace App\Components\Pages\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class PagesResource extends JsonResource
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
            'id'             => (int) $this->id,
            'title'          => (string) $this->title,
            'excerpt'        => (string) $this->excerpt,
            'content'        => (string) $this->content,
        ];
    }
}
