<?php

namespace App\Components\Clients\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResources extends JsonResource
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
            'id'                    => (int) $this->id,
            'name'                  => (string) $this->name,
            'image'                 => (string) $this->image_path,
            'advertises_count'      => $this->advertises->count(),
            'followers_count'       => \DB::table('followers')->where('followed_id', \Auth::user()->id)->count(),
            'rate'                  => ($this->rate()->count()) ? $this->rate()->avg('value') : 0,
        ];
    }
}
