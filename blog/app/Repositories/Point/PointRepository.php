<?php

namespace App\Repositories\Point;

use App\Models\Point;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Repositories\Point\PointRepositoryInterface;

class PointRepository extends BaseRepository implements PointRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Point::class;
    }
    
    public function averagepointbyuser($id)
    {
        return
            Point::join('users', 'users.id', '=', 'points.target_id')
            ->select(
                DB::raw('cast(round(cast(avg(points.star) as decimal(2,1)),1) as float) as star'),
            )
            ->whereNull('users.deleted')
            ->whereNull('points.deleted')
            ->where('points.target_id', $id)
            ->groupby('points.target_id')
            ->first();
    }

    public function getuserpointbyblog($id, $blog_id)
    {
        return
            Point::join('users', 'users.id', '=', 'points.target_id')
            ->select(
                'points.star as point',
                'points.description',
            )
            ->whereNull('users.deleted')
            ->whereNull('points.deleted')
            ->where('points.created_by', $id)
            ->where('points.blog_id', $blog_id)
            ->first();
    }

    public function findpointbyblog($id)
    {
        return
            Point::join('users', 'users.id', '=', 'points.created_by')
            ->join('blogs', 'blogs.id', '=', 'points.blog_id')
            ->select(
                'points.id',
                'points.blog_id',
                'points.target_id',
                'points.star',
                'points.description',
                'points.created_by',
				'points.updated_at',
                'users.name AS user_name',
                'blogs.created_by AS owner',
            )
            ->whereNull('users.deleted')
            ->whereNull('blogs.deleted')
            ->whereNull('points.deleted')
            ->where('points.blog_id', $id)
            ->orderBy('points.id', 'desc')
            ->get();
    }

    public function findpointbyuser($id)
    {
        return
            Point::join('users', 'users.id', '=', 'points.created_by')
            ->join('blogs', 'blogs.id', '=', 'points.blog_id')
            ->select(
                'points.id',
                'points.blog_id',
                'points.target_id',
                'points.star',
                'points.description',
                'points.created_by',
				'points.updated_at',
                'users.name AS user_name',
                'blogs.created_by AS owner',
            )
            ->whereNull('users.deleted')
            ->whereNull('blogs.deleted')
            ->whereNull('points.deleted')
            ->where('points.target_id', $id)
            ->orderBy('points.id', 'desc')
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