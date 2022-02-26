<?php

namespace App\Repositories\Blogselect;

use App\Models\Blogselect;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Repositories\BlogSelect\BlogselectRepositoryInterface;

class BlogselectRepository extends BaseRepository implements BlogselectRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Blogselect::class;
    }

    public function getAll()
    {
    }

    public function find($id)
    {
        return
            Blogselect::join('users', 'users.id', '=', 'blogselects.created_by')
            ->join('blogs', 'blogs.id', '=', 'blogselects.blog_id')
            ->select(
                'blogselects.id',
                'blogselects.blog_id',
                'blogselects.description',
                'blogselects.money',
                'blogselects.status',
                'blogselects.created_by',
				'blogselects.updated_at',
                'users.name AS user_name',
                'blogs.created_by AS owner',
            )
            ->whereNull('users.deleted')
            ->whereNull('blogs.deleted')
            ->find($id);
    }

    public function findselectbyblog($id)
    {
        return
            Blogselect::join('users', 'users.id', '=', 'blogselects.created_by')
            ->join('blogs', 'blogs.id', '=', 'blogselects.blog_id')
            ->select(
                'blogselects.id',
                'blogselects.blog_id',
                'blogselects.description',
                'blogselects.money',
                'blogselects.status',
                'blogselects.created_by',
				'blogselects.updated_at',
                'users.name AS user_name',
                'blogs.created_by AS owner',
            )
            ->whereNull('users.deleted')
            ->whereNull('blogs.deleted')
            ->where('blogselects.blog_id', $id)
            ->orderBy('blogselects.status', 'desc')
            ->orderBy('blogselects.id', 'desc')
            ->get();
    }

    public function findchoosenselectbyblog($id)
    {
        return
            Blogselect::join('users', 'users.id', '=', 'blogselects.created_by')
            ->join('blogs', 'blogs.id', '=', 'blogselects.blog_id')
            ->select(
                'blogselects.id',
                'blogselects.blog_id',
                'blogselects.description',
                'blogselects.money',
                'blogselects.status',
                'blogselects.created_by',
				'blogselects.updated_at',
                'users.name AS user_name',
                'blogs.created_by AS owner',
            )
            ->whereNull('users.deleted')
            ->whereNull('blogs.deleted')
            ->where('blogselects.blog_id', $id)
            ->where('blogselects.status', 1)
            ->orderBy('blogselects.id', 'desc')
            ->get();   
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