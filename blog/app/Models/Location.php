<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'id', 'location_name'
    ];

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }

    public function blog()
    {
        return $this->hasMany('App\Models\Blog');
    }
}
