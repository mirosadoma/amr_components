<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = "tokens";
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(City::class);
    }
}
