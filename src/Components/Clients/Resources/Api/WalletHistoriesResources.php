<?php

namespace App\Components\Clients\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class WalletHistoriesResources extends JsonResource
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
            'balance'           => (double) $this->balance,
            'user'              => (string) $this->user->name,
            'created_date'      => (string) $this->created_at ? $this->created_at->toDateString() : "",
            'created_time'      => (string) $this->created_at ? $this->created_at->toTimeString() : "",
        ];
    }
}
