<?php

namespace App\Models;

use App\Traits\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use SoftDeletes;

    const DELETED_AT = 'deleted';

    const CREATED_AT = 'created_at';
    const CREATED_BY = 'created_by';

    const UPDATED_AT = 'updated_at';
    const UPDATED_BY = 'updated_by';

    protected function updateTimestamps()
    {
        $time = $this->freshTimestamp();

        $user = Auth::user();

        if (!$this->isDirty(static::UPDATED_AT)) {
            $this->setUpdatedAt($time);
            $this->setUpdateBy($user);
        }

        if (!$this->exists && !$this->isDirty(static::CREATED_AT)) {
            $this->setCreatedAt($time);
            $this->setCreateBy($user);
        }
    }

    public function setCreateBy($user)
    {
        if ($user) {
            $this->{static::CREATED_BY} = $user->id;
        }
    }

    public function setUpdateBy($user)
    {
        if ($user) {
            $this->{static::UPDATED_BY} = $user->id;
        }
    }
}
