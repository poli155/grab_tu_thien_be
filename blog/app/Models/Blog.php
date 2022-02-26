<?php

namespace App\Models;

class Blog extends BaseAuth
{
    protected $fillable = [
        'id', 'status', 'title', 'location_id', 'date', 'description', 'target', 'receive', 'created_by', 'updated_by'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function comment()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function select()
    {
        return $this->hasMany('App\Models\Blogselect');
    }

    public function location()
    {
        return $this->belongsTo('App\Models\Location');
    }

    public function star()
    {
        return $this->hasMany('App\Models\Star');
    }

    public function point()
    {
        return $this->hasMany('App\Models\Point');
    }
}
