<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Repositories\User\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    public function getModel()
    {
        return \App\Models\User::class;
    }

    public function getUserByEmail($email)
    {
        return User::join('roles', 'roles.id', '=', 'users.role_id')
        ->leftJoin('locations', 'locations.id', '=', 'users.location_id')
        ->select(
            'users.id',
            'users.email',
            'users.name',
            'roles.role_name',
            'users.phone',
            'locations.location_name',
            'users.role_id',
            'users.location_id',
            'users.birthday',
            'users.status'
        )
            ->where(['users.email' => $email])
            ->first();
    }
    public function getAll()
    {
        return User::join('roles', 'roles.id', '=', 'users.role_id')
        ->leftJoin('locations', 'locations.id', '=', 'users.location_id')
        ->select(
            'users.id',
            'users.email',
            'users.name',
            'roles.role_name',
            'users.phone',
            'locations.location_name',
            'users.role_id',
            'users.location_id',
            'users.birthday',
            'users.status'
        )
            ->orderBy('users.id', 'asc')
            ->get();
    }

    public function find($id)
    {
        return
            User::join('roles', 'users.role_id', '=', 'roles.id')
            ->leftJoin('locations', 'locations.id', '=', 'users.location_id')
            ->select(
                'users.id',
                'users.email',
                'users.name',
                'roles.role_name',
                'users.phone',
                'locations.location_name',
                'users.role_id',
                'users.location_id',
                'users.birthday',
                'users.status'
            )
            ->find($id);
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();
            return true;
        }

        return false;
    }

    public function search($query)
    {

        return User::join('roles', 'users.role_id', '=', 'roles.id')
        ->leftJoin('locations', 'locations.id', '=', 'users.location_id')
            ->select(
                'users.id',
                'users.email',
                'users.name',
                'roles.role_name',
                'users.phone',
                'locations.location_name',
                'users.birthday',
                'users.status'
            )
            ->where('users.name', 'ilike', '%'.$query.'%' )
            ->orderBy('users.id', 'asc');
    }
}
