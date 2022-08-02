<?php

namespace App\Components\Notifications\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $lang = $request->header('Api-Lang');
        Carbon::setLocale($lang);
        return [
            'id'    => (int) $this['data']['notify_id'],
            'title' => (string) $this['data'][$lang],
            'read'  => (int) (boolean) $this['read_at'],
            'date'  => (string) Carbon::parse($this['created_at'])->diffForHumans(),
            'type'  => $this['data']['url'] ? (string) explode("/", $this['data']['url'] , 2)[0] : ''
        ];
    }
}
