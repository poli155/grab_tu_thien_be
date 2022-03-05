<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Repositories\Blogselect\BlogselectRepositoryInterface;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Repositories\Star\StarRepositoryInterface;
use App\Repositories\Point\PointRepositoryInterface;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\BlogInput;
use App\Http\Requests\UpdateBlogInput;
use Carbon\Carbon;

class BlogController extends Controller
{
    protected $blogRepo;

    public function __construct(BlogRepositoryInterface $blogRepo, BlogselectRepositoryInterface $selectRepo, 
    CommentRepositoryInterface $commentRepo, StarRepositoryInterface $starRepo, PointRepositoryInterface $pointRepo)
    {
        $this->blogRepo = $blogRepo;
        $this->selectRepo = $selectRepo;
        $this->commentRepo = $commentRepo;
        $this->starRepo = $starRepo;
        $this->pointRepo = $pointRepo;
    }
    public function index()
    {
        return $this->blogRepo->getAll();
    }
    public function showBlogByUser($id)
    {
        return $this->blogRepo->getByUser($id);
    }
    public function showBlogWithSelect($id)
    {
        return $this->blogRepo->getWithSelect($id);
    }
    public function searchBlog($location_id, $status, $sort)
    {
        if ( 0 < $location_id && $location_id < 64){
            $conditions[] = "blogs.location_id = $location_id";
        }
        switch($status) {
            case 0:
                $conditions[] = "blogs.status = $status";
                $conditions[] = "blogs.date >= NOW()";
                break;
            case 1:
                $conditions[] = "blogs.status = $status";
                $conditions[] = "blogs.date >= NOW()";
                break;
            case 2:
                $conditions[] = "blogs.date < NOW()";
                break;
            default:
                $conditions[] = "blogs.status != 3";
        };
        switch($sort){
            case 1:
                $order = 'blogs.date';
				$ordertype = 'desc';
                break;
			case 2:
				$order = 'blogs.date';
				$ordertype = 'asc';
                break;
            case 3:
                $order = 'blogs.updated_at';
				$ordertype = 'desc';
                break;
			case 4:
				$order = 'blogs.updated_at';
				$ordertype = 'asc';
                break;
            default:
                $order = 'blogs.date';
				$ordertype = 'desc';
        };
        return $this->blogRepo->searchBlog($conditions, $order, $ordertype);
    }
    public function create($attributes)
    {
        return $attributes;
    }
    public function store(BlogInput $request)
    {
        $input = [
            'title' => $request->get('title'),
            'description' =>  $request->get('description'),
            'target' => $request->get('target'),
            'status' => 1,
            'location_id' => $request->get('location_id'),
            'date' => $request->get('date'),
        ];
        if ($this->blogRepo->create($input)) {
            return response()->json([
                'message' => 'Create Blog Successfully'
            ], Response::HTTP_CREATED);
        } else {
            return response()->json([
                'message' => 'Create Blog Failed'
            ], Response::HTTP_BAD_REQUEST);
        }
    }
    public function show($id)
    {
        $blog = $this->blogRepo->find($id);
        $point = $this->pointRepo->averagepointbyuser($blog['created_by']);
        $blog->point = $point?$point['star']:null;
        if ($blog) {
            return $blog;
        } else {
            return response()->json([
                'message' => 'Blog not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }
    public function edit()
    {
    }
    public function update(UpdateBlogInput $request, $id)
    {        
        if ($request->all() === []) {
            return response(['message' => 'Nothing to update'], Response::HTTP_BAD_REQUEST);
        }
        $blog = $this->blogRepo->find($id);
        $attributes = [
            'title' => $request->get('title') ?? $blog->title,
            'description' => $request->get('description') ?? $blog->description,
            'status' => $request->get('status') ?? $blog->status,
            'target' => $request->get('target') ?? $blog->target,
            'location_id' => $request->get('location_id') ?? $blog->location_id,
            'date' => $request->get('date') ?? $blog->date,
        ];
        if ($blog['created_by'] == auth()->user()->id or auth()->user()->role_id == 1) {
            if ($this->blogRepo->update($id, $attributes)) {
                return response([
                    'message' => 'Update successfully'
                ], Response::HTTP_OK);
            } else {
                return response([
                    'message' => 'Update failed'
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response([
                'message' => 'Need Permission'
            ], Response::HTTP_BAD_REQUEST);
        }
    }
    public function destroy($id)
    {
        $blog = $this->blogRepo->find($id);
        if ($blog['created_by'] == auth()->user()->id or auth()->user()->role_id == 1) {
            if ($this->blogRepo->delete($id)) {
                return response([
                    'message' => 'Delete successfully'
                ], Response::HTTP_OK);
            } else {
                return response([
                    'message' => 'Delete failed'
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response([
                'message' => 'Need Permission'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function showselect($id)
    {
        $select = $this->selectRepo->find($id);
        $star = $this->starRepo->averagestarbyuser($select['created_by']);
        $select->star = $star?$star['star']:null;
        if ($select) {
            return $select;
        } else {
            return response()->json([
                'message' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }   
    }

    public function showselectbyblog($id)
    {
        $selects = $this->selectRepo->findselectbyblog($id);
        foreach($selects as $select){
            $star = $this->starRepo->averagestarbyuser($select['created_by']);
            $starselect = $this->starRepo->getuserstarbyblog($select['created_by'],$select['blog_id']);
            $select->star = $star?$star['star']:null;
            $select->starselect = $starselect?$starselect['star']:null;
            $select->stardescription = $starselect?$starselect['description']:null;
            $select->starid = $starselect?$starselect['id']:null;
        }
        if ($selects) {
            return $selects;
        } else {
            return response()->json([
                'message' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }   
    }

    public function addselect(Request $request, $id)
    {
        $select = json_decode($this->selectRepo->findselectbyblog($id), true);
        $helper = auth()->user()->id;
        $filtered = array_filter($select, function($item) use ($helper) {
            return $item['created_by'] == $helper;
        });
        $blog = $this->blogRepo->find($id);
        $input = [
            'blog_id' => $id,
            'description' =>  $request->get('description'),
            'money' => $request->get('money'),
            'status' => 0,
        ];
        if ( $filtered==null and $blog['status'] != 0 and $blog['date'] >= Carbon::now()->format('Y-m-d') and auth()->user()->role_id != 3 and $this->selectRepo->create($input)) {
            return response()->json([
                'message' => 'Select Successfully'
            ], Response::HTTP_CREATED);
        } else {
            return response()->json([
                'message' => 'Select Failed'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function editselect(Request $request, $id)
    {
        $select = $this->selectRepo->find($id);
        $attributes = [
            'description' =>  $request->get('description'),
            'money' => $request->get('money'),
        ];
        if ( ($select['created_by'] == auth()->user()->id or auth()->user()->role_id == 1) and $this->selectRepo->update($id, $attributes)) {
            return response([
                'message' => 'Update successfully'
            ], Response::HTTP_OK);
        } else {
            return response([
                'message' => 'Update failed'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function confirmselect(Request $request, $id)
    {
        $select = $this->selectRepo->find($id);
        $blog = $this->blogRepo->find($select['blog_id']);
        if ($select['status'] == 0) {
            $attributes = [
                'status' => 1,
            ];
            $receive = $blog['receive'] + $select['money'];
            $blog_attributes = [
                'receive' => $receive,
            ];
            if ( ($select['owner'] == auth()->user()->id or auth()->user()->role_id == 1) and ($blog['receive'] + $select['money'] <= $blog['target']) and $this->selectRepo->update($id, $attributes)) {
                $this->blogRepo->update($select['blog_id'], $blog_attributes);
                return response([
                    'message' => 'Update successfully'
                ], Response::HTTP_OK);
            } else {
                return response([
                    'message' => 'Update failed'
                ], Response::HTTP_BAD_REQUEST);
            }
        }
        else {
            $attributes = [
                'status' => 0,
            ];
            $receive = $blog['receive'] - $select['money'];
            $blog_attributes = [
                'receive' => $receive,
            ];
            if ( ($select['owner'] == auth()->user()->id or auth()->user()->role_id == 1) and $this->selectRepo->update($id, $attributes)) {
                $this->blogRepo->update($select['blog_id'], $blog_attributes);
                return response([
                    'message' => 'Update successfully'
                ], Response::HTTP_OK);
            } else {
                return response([
                    'message' => 'Update failed'
                ], Response::HTTP_BAD_REQUEST);
            }
        }
    }

    public function deleteselect($id)
    {
        $select = $this->selectRepo->find($id);
        if ( ($select['created_by'] == auth()->user()->id or auth()->user()->role_id == 1) and $this->selectRepo->delete($id)) {
            return response([
                'message' => 'Delete successfully'
            ], Response::HTTP_OK);
        } else {
            return response([
                'message' => 'Delete failed'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function showcomment($id)
    {
        $comment = $this->commentRepo->find($id);
        $star = $this->starRepo->averagestarbyuser($comment['created_by']);
        $comment->star = $star?$star['star']:null;
        if ($comment) {
            return $comment;
        } else {
            return response()->json([
                'message' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }   
    }

    public function showcommentbyblog($id)
    {
        $comments = $this->commentRepo->findcommentbyblog($id);
        foreach($comments as $comment){
            $star = $this->starRepo->averagestarbyuser($comment['created_by']);
            $comment->star = $star?$star['star']:null;
        }
        if ($comments) {
            return $comments;
        } else {
            return response()->json([
                'message' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }   
    }

    public function addcomment(Request $request, $id)
    {
        $input = [
            'blog_id' => $id,
            'description' =>  $request->get('description'),
        ];
        if ( $this->commentRepo->create($input)) {
            return response()->json([
                'message' => 'Create Comment Successfully'
            ], Response::HTTP_CREATED);
        } else {
            return response()->json([
                'message' => 'Create Comment Failed'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function editcomment(Request $request, $id)
    {
        $comment = $this->commentRepo->find($id);
        $attributes = [
            'description' =>  $request->get('description'),
        ];
        if (($comment['created_by'] == auth()->user()->id or auth()->user()->role_id == 1) and $this->commentRepo->update($id, $attributes)) {
            return response([
                'message' => 'Update successfully'
            ], Response::HTTP_OK);
        } else {
            return response([
                'message' => 'Update failed'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function deletecomment($id)
    {
        $comment = $this->commentRepo->find($id);
        if (($comment['created_by'] == auth()->user()->id or auth()->user()->role_id == 1) and $this->commentRepo->delete($id)) {
            return response([
                'message' => 'Delete successfully'
            ], Response::HTTP_OK);
        } else {
            return response([
                'message' => 'Delete failed'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function evaluatehelper(Request $request, $id)
    {
        $blogselect = $this->selectRepo->find($id);
        $input = [
            'blog_id' => $blogselect['blog_id'],
            'target_id' => $blogselect['created_by'],
            'star' => $request->get('star'),
            'result' => $request->get('result'),
            'attitude' => $request->get('attitude'),
            'suggest' => $request->get('suggest'),
            'description' =>  $request->get('description'),
        ];
        if ( $this->starRepo->create($input)) {
            return response()->json([
                'message' => 'Evaluate Successfully'
            ], Response::HTTP_CREATED);
        } else {
            return response()->json([
                'message' => 'Evaluate Failed'
            ], Response::HTTP_BAD_REQUEST);
        }        
    }

    public function editstar(Request $request, $id)
    {
        $star = $this->starRepo->find($id);
        $attributes = [
            'star' => $request->get('star'),
            'result' => $request->get('result'),
            'attitude' => $request->get('attitude'),
            'suggest' => $request->get('suggest'),
            'description' =>  $request->get('description'),
        ];
        if (($star['created_by'] == auth()->user()->id) and $this->starRepo->update($id, $attributes)) {
            return response([
                'message' => 'Update successfully'
            ], Response::HTTP_OK);
        } else {
            return response([
                'message' => 'Update failed'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function evaluatecustomer(Request $request, $id)
    {
        $blog = $this->blogRepo->find($id);
        $input = [
            'blog_id' => $id,
            'target_id' => $blog['created_by'],
            'star' => $request->get('star'),
            'description' =>  $request->get('description'),
            'result' => $request->get('result'),
            'attitude' => $request->get('attitude'),
            'suggest' => $request->get('suggest'),
        ];
        if ( $this->pointRepo->create($input)) {
            return response()->json([
                'message' => 'Evaluate Successfully'
            ], Response::HTTP_CREATED);
        } else {
            return response()->json([
                'message' => 'Evaluate Failed'
            ], Response::HTTP_BAD_REQUEST);
        }        
    }

    public function editpoint(Request $request, $id)
    {
        $point = $this->pointRepo->find($id);
        $attributes = [
            'star' => $request->get('star') ?? $point->star,
            'result' => $request->get('result'),
            'attitude' => $request->get('attitude'),
            'suggest' => $request->get('suggest'),
            'description' =>  $request->get('description'),
        ];
        if (($point['created_by'] == auth()->user()->id) and $this->pointRepo->update($id, $attributes)) {
            return response([
                'message' => 'Update successfully'
            ], Response::HTTP_OK);
        } else {
            return response([
                'message' => 'Update failed'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function getPointEvaluate($id, $blog_id)
    {
        $result = $this->pointRepo->getuserpointbyblog($id, $blog_id); 
        if ($result) {
            return $result;
        } else {
            return null;
        }
    }

    public function showpointbyblog($id)
    {
        $point = $this->pointRepo->findpointbyblog($id);
        if ($point) {
            return $point;
        } else {
            return response()->json([
                'message' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }   
    }

    public function showpointbyuser($id)
    {
        $point = $this->pointRepo->findpointbyuser($id);
        if ($point) {
            return $point;
        } else {
            return response()->json([
                'message' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }   
    }

    public function showpoint($id)
    {
        $point = $this->pointRepo->find($id);
        if ($point) {
            return $point;
        } else {
            return response()->json([
                'message' => 'Not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function showstar($id)
    {
        $star = $this->starRepo->find($id);
        if ($star) {
            return $star;
        } else {
            return response()->json([
                'message' => 'Not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function showstarbyuser($id)
    {
        $star = $this->starRepo->findstarbyuser($id);
        if ($star) {
            return $star;
        } else {
            return response()->json([
                'message' => 'Not Found'
            ], Response::HTTP_NOT_FOUND);
        }   
    }

    public function getStarEvaluate($id, $blog_id)
    {
        $result = $this->starRepo->getuserstarbyblog($id, $blog_id); 
        if ($result) {
            return $result;
        } else {
            return null;
        }
    }

}
