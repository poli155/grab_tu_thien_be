<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterInput;
use App\Http\Requests\UpdateProfileInput;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Star\StarRepositoryInterface;
use App\Repositories\Point\PointRepositoryInterface;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
/**
 * This controller help admin manage users
 */
class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo, StarRepositoryInterface $starRepo, PointRepositoryInterface $pointRepo)
    {
        $this->userRepo = $userRepo;
        $this->starRepo = $starRepo;
        $this->pointRepo = $pointRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->userRepo->getAll();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($attributes)
    {
        return $attributes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterInput $request)
    {
        $input = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make(
                $request->get('password')
            ),
            'birthday' => $request->get('birthday'),
            'phone' => $request->get('phone'),
            'location_id' => $request->get('location_id'),
            'role_id' =>  $request->get('role_id'),
        ];
        if ($this->userRepo->create($input)) {
            return response()->json([
                'message' => 'Create User Successfully'
            ], Response::HTTP_CREATED);
        } else {
            return response()->json([
                'message' => 'Create User Failed'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->userRepo->find($id);
        $star = $this->starRepo->averagestarbyuser($id);
        $point = $this->pointRepo->averagepointbyuser($id);
        $user->star = $star?$star['star']:null;
        $user->point = $point?$point['star']:null;
        if ($user) {
            return $user;
        } else {
            return response()->json([
                'message' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $params
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userRepo->find($id);
        if ($user) {
            return $user;
        } else {
            return response()->json([
                'message' => 'User not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileInput $request, $id)
    {
        if ($request->all() === []) {
            return response(['message' => 'Nothing to update'], Response::HTTP_BAD_REQUEST);
        }
        $user_id = auth()->user()->id;
        
        $currentUser = $this->userRepo->find($id);
        if($user_id==$id && $request->get('role_id') !==$currentUser['role_id']) {
            return response([
                'message' => 'Update at profile'
            ], Response::HTTP_BAD_REQUEST);
        }
        if (!$currentUser) {
            return response()->json([
                'message' => 'Not found'
            ], Response::HTTP_NOT_FOUND);
        }
        $attributes = [
            'phone' => $request->get('phone') ?? $currentUser->phone,
            'locaion_id' => $request->get('location_id') ?? $currentUser->location_id,
            'birthday' => $request->get('birthday') ?? $currentUser->birthday,
            'name' => $request->get('name') ?? $currentUser->name,
        ];
        if (isset($request['password'])) {
            $attributes['password'] = Hash::make($request->get('password'));
        }
        if (isset($request['role_id'])) {
            $attributes['role_id'] = $request->get('role_id');
        }
        if ($this->userRepo->update($id, $attributes)) {
            return response([
                'message' => 'Update successfully'
            ], Response::HTTP_OK);
        } else {
            return response([
                'message' => 'Update failed'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->id == $id) {
            return response([
                'message' => "Admin can't delete sefl"
            ], Response::HTTP_BAD_REQUEST);
        }

        if ($this->userRepo->delete($id)) {
            return response([
                'message' => 'Delete successfully'
            ], Response::HTTP_OK);
        } else {
            return response([
                'message' => 'Delete failed'
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
