<?php

namespace App\Components\Cities\Models\Translation;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = "cities_translations";
    protected $fillable = ['name'];
    protected $guarded = ['city_id'];
    public $timestamps = false;
}