<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    function socialMedia()
    {
        return $this->hasMany(SocialMedia::class);
    }

    function categories()
    {
        return $this->hasMany(Category::class);
    }

    function cards()
    {
        return $this->hasMany(Card::class);
    }
}
