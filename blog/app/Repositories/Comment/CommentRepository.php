<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Repositories\Comment\CommentRepositoryInterface;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Comment::class;
    }

    public function getAll()
    {
    }

    public function find($id)
    {
        return
            Comment::join('users', 'users.id', '=', 'comments.created_by')
            ->join('blogs', 'blogs.id', '=', 'comments.blog_id')
            ->select(
                'comments.id',
                'comments.blog_id',
                'comments.description',
                'comments.created_by',
		        'comments.updated_at',
                'users.name AS user_name',
            )
            ->whereNull('users.deleted')
            ->whereNull('blogs.deleted')
            ->find($id);
    }

    public function findcommentbyblog($id)
    {
        return
            Comment::join('users', 'users.id', '=', 'comments.created_by')
            ->join('blogs', 'blogs.id', '=', 'comments.blog_id')
            ->select(
                'comments.id',
                'comments.blog_id',
                'comments.description',
                'comments.created_by',
		        'comments.updated_at',
                'users.name AS user_name',
            )
            ->whereNull('users.deleted')
            ->whereNull('blogs.deleted')
            ->where('comments.blog_id', $id)
            ->orderBy('comments.id', 'desc')
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