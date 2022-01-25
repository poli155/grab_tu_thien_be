<?php

namespace App\Repositories\Blogselect;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface BlogselectRepositoryInterface extends RepositoryInterface
{
    public function findselectbyblog($id);
    public function findchoosenselectbyblog($id);
}
