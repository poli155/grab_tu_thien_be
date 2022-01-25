<?php

namespace App\Repositories\Star;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface StarRepositoryInterface extends RepositoryInterface
{
    public function averagestarbyuser($id);
    public function getuserstarbyblog($id, $blog_id);
}
