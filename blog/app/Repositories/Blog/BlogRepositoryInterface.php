<?php

namespace App\Repositories\Blog;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface BlogRepositoryInterface extends RepositoryInterface
{
    public function getByUser($id);
    public function getWithSelect($id);
    public function searchBlog($conditions, $order, $ordertype);
}
