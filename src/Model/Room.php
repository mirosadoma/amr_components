<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Message;
use App\Models\User;

class Room extends Model
{
    protected $table = "rooms";
    protected $guarded = ['id'];

    public function practicer()
    {
        return $this->belongsTo(User::class, 'practicer_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'room_id');
    }

    public function group()
    {
        return $this->belongsTo(User::class, 'group_id');
    }
}
