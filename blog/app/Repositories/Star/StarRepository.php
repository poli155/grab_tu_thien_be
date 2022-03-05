<?php

namespace App\Repositories\Star;

use App\Models\Star;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Repositories\Star\StarRepositoryInterface;

class StarRepository extends BaseRepository implements StarRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Star::class;
    }
    
    public function averagestarbyuser($id)
    {
        return
            Star::join('users', 'users.id', '=', 'stars.target_id')
            ->select(
                DB::raw('cast(round(cast(avg(stars.star) as decimal(2,1)),1) as float) as star'),
            )
            ->whereNull('users.deleted')
            ->whereNull('stars.deleted')
            ->where('stars.target_id', $id)
            ->groupby('stars.target_id')
            ->first();
    }

    public function getuserstarbyblog($id, $blog_id)
    {
        return
            Star::join('users', 'users.id', '=', 'stars.target_id')
            ->select(
                'stars.id',
                'stars.star',
                'stars.description',
            )
            ->whereNull('users.deleted')
            ->whereNull('stars.deleted')
            ->where('stars.target_id', $id)
            ->where('stars.blog_id', $blog_id)
            ->first();
    }

    public function findstarbyuser($id)
    {
        return
            Star::join('users', 'users.id', '=', 'stars.created_by')
            ->join('blogs', 'blogs.id', '=', 'stars.blog_id')
            ->select(
                'stars.id',
                'stars.blog_id',
                'stars.target_id',
                'stars.star',
                'stars.description',
                'stars.result',
                'stars.attitude',
                'stars.suggest',
                'stars.created_by',
				'stars.updated_at',
                'users.name AS user_name',
                'blogs.created_by AS owner',
            )
            ->whereNull('users.deleted')
            ->whereNull('blogs.deleted')
            ->whereNull('stars.deleted')
            ->where('stars.target_id', $id)
            ->orderBy('stars.id', 'desc')
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