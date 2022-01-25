<?php

namespace App\Traits;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

trait RecordSignature
{
    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {

            $model->updated_by = JWTAuth::User()->id ?? User::max('id') + 1;
        });

        static::creating(function ($model) {

            $model->created_by = JWTAuth::User()->id ?? User::max('id') + 1;
        });

        static::deleting(function ($model) {
            $model->updated_by = JWTAuth::User()->id;
        });
        //etc

    }
}
