<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'owner',
    ];

    protected $hidden = [

    ];

    // protected $casts = [
    //     'password' => 'hashed',
    // ];
}
