<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fbalbum extends Model
{
    //
    protected $table = 'fbalbum';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'album_id', 'album_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
