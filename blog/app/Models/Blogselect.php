<?php

namespace App\Models;

class Blogselect extends BaseAuth
{
    protected $fillable = [
        'id', 'blog_id', 'description', 'status', 'created_by', 'updated_by'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function blog()
    {
        return $this->belongsTo('App\Models\Blog');
    }
}
