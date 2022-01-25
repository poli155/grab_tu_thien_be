<?php

namespace App\Repositories\Point;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface PointRepositoryInterface extends RepositoryInterface
{
    public function averagepointbyuser($id);
    public function getuserpointbyblog($id, $blog_id);
    public function findpointbyblog($id);
}
