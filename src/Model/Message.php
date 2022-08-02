<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Room;
use App\Models\User;

class Message extends Model
{
    protected $table = "messages";
    protected $guarded = ['id'];

    public function room()
    {
        return $this->belongsTo(room::class, 'room_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
