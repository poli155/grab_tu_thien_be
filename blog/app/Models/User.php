<?php

namespace App\Models;

class User extends BaseAuth
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'role_id', 'name', 'location_id', 'phone', 'birthday', 'status', 'created_by', 'update_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function location()
    {
        return $this->belongsTo('App\Models\Location');
    }

    public function blog()
    {
        return $this->hasMany('App\Models\Blog');
    }

    public function select()
    {
        return $this->hasMany('App\Models\BlogSelect');
    }

    public function comment()
    {
        return $this->hasMany('App\Models\Comment');
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
