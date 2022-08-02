<?php

namespace App\Components\Pages\Models\Translation;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = "pages_translations";
    protected $fillable = ['title','excerpt','content','slug'];
    protected $guarded = ['page_id'];
    public $timestamps = false;
}