<?php

namespace App\Repositories\Blog;

use App\Models\Blog;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Repositories\Blog\BlogRepositoryInterface;

class BlogRepository extends BaseRepository implements BlogRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Blog::class;
    }

    public function getAll()
    {
        return Blog::leftjoin('users', 'users.id', '=', 'blogs.created_by')
        ->join('locations', 'locations.id', '=', 'blogs.location_id')
        ->select(
            'blogs.id',
            'users.name',
            'users.email',
            'users.phone',
            'blogs.status',
            'blogs.title',
            'blogs.description',
            'blogs.target',
            'blogs.receive',
            'blogs.location_id',
            'locations.location_name',
            'blogs.date',
            'blogs.created_by',
        )
            ->whereNull('users.deleted')
            ->orderBy('blogs.id', 'desc')
            ->paginate(5);
    }

    public function getByUser($id)
    {
        return Blog::join('users', 'users.id', '=', 'blogs.created_by')
        ->join('locations', 'locations.id', '=', 'blogs.location_id')
        ->select(
            'blogs.id',
            'users.name',
            'users.email',
            'users.phone',
            'blogs.status',
            'blogs.title',
            'blogs.description',
            'blogs.target',
            'blogs.receive',
            'blogs.location_id',
            'locations.location_name',
            'blogs.date',
            'blogs.created_by',
        )
            ->where('blogs.created_by', $id)
            ->whereNull('users.deleted')
            ->orderBy('blogs.id', 'desc')
            ->paginate(5);
    }

    public function getWithSelect($id)
    {
        return Blog::join('users', 'users.id', '=', 'blogs.created_by')
        ->join('locations', 'locations.id', '=', 'blogs.location_id')
        ->join('blogselects', 'blogselects.blog_id', '=', 'blogs.id')
        ->select(
            'blogs.id',
            'users.name',
            'users.email',
            'users.phone',
            'blogs.status',
            'blogs.title',
            'blogs.description',
            'blogs.target',
            'blogs.receive',
            'blogs.location_id',
            'locations.location_name',
            'blogs.date',
            'blogs.created_by',
        )
            ->where('blogselects.created_by', $id)
            ->whereNull('blogselects.deleted')
            ->orderBy('blogs.id', 'desc')
            ->paginate(5);
    }

    public function find($id)
    {
        return
            Blog::join('users', 'users.id', '=', 'blogs.created_by')
            ->join('locations', 'locations.id', '=', 'blogs.location_id')
            ->select(
                'blogs.id',
                'users.name',
                'users.email',
                'users.phone',
                'blogs.status',
                'blogs.title',
                'blogs.description',
                'blogs.target',
                'blogs.receive',
                'blogs.location_id',
                'locations.location_name',
                'blogs.date',
                'blogs.created_by'
            )
            ->whereNull('users.deleted')
            ->find($id);
    }

    public function searchBlog($conditions, $order, $ordertype)
    {
        return Blog::join('users', 'users.id', '=', 'blogs.created_by')
        ->join('locations', 'locations.id', '=', 'blogs.location_id')
        ->select(
            'blogs.id',
            'users.name',
            'users.email',
            'users.phone',
            'blogs.status',
            'blogs.title',
            'blogs.description',
            'blogs.target',
            'blogs.receive',
            'blogs.location_id',
            'locations.location_name',
            'blogs.date',
            'blogs.created_by',
        )
            ->whereNull('users.deleted')
            ->where(function ($query) use ($conditions){
                foreach($conditions as $condition){
                    $query -> whereRaw($condition);
                }
            })
            ->orderBy($order, $ordertype)
            ->paginate(5);
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
}