<?php

namespace App\Models;

class Star extends BaseAuth
{
    protected $fillable = [
        'id', 'blog_id', 'target_id', 'star', 'description', 'result', 'attitude', 'suggest', 'created_by', 'updated_by'
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
