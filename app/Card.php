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
        return Category::find($this->category_id)->socialMedia;
    }
}
