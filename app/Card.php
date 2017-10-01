<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $guarded = ['id'];

    function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    function socialMedia()
    {
        return $this->belongsTo(Category::class, 'category_id')->socialMedia;
    }
}
