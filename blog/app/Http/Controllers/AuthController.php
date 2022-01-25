<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginInput;
use App\Http\Requests\RegisterInput;
use App\Http\Requests\UpdatePasswordInput;
use App\Http\Requests\UpdateProfileInput;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\Star\StarRepositoryInterface;
use App\Repositories\Point\PointRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo, StarRepositoryInterface $starRepo, PointRepositoryInterface $pointRepo)
    {
        $this->userRepo = $userRepo;
        $this->starRepo = $starRepo;
        $this->pointRepo = $pointRepo;
    }
    public function register(RegisterInput $request)
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
                'message' => 'Register Successfully'
            ], Response::HTTP_CREATED);
        } else {
            return response()->json([
                'message' => 'Register Failed'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function login(LoginInput $request)
    {

        $input = $request->only('email', 'password');
        $test = JWTAuth::attempt($input);
        $jwt_token = null;
        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'message' => 'Login Failed!'
            ], Response::HTTP_BAD_REQUEST);
        }
        $user = $this->userRepo->getUserByEmail($request->email);
        return response()->json([
            'token' => $jwt_token,
            'user' => $user,
        ], Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate(auth());
            return response()->json([
                'message' => 'Logout'
            ], Response::HTTP_OK);
        } catch (JWTException $exception) {
            return response()->json([
                'message' => 'Logout Failed!'
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }
    }

    public function getAuthUser(Request $request)
    {
        $auth_user = auth()->user();
        $user = $this->userRepo->find($auth_user->id);
        return response()->json(['user' => $user], Response::HTTP_OK);
    }

    public function updatePassword(UpdatePasswordInput $request)
    {
        if (Hash::check($request->password, JWTAuth::user()->password) == false) {
            return response(['message' => 'Password incorrect'], Response::HTTP_BAD_REQUEST);
        }

        $user_id = auth()->user()->id;
        $attributes = [
            'password' => Hash::make($request->new_password)
        ];
        if ($this->userRepo->update($user_id, $attributes)) {
            return response([
                'message' => 'Update password successfully'
            ], Response::HTTP_OK);
        } else {
            return response([
                'message' => 'Update password failed'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function updateProfile(UpdateProfileInput $request)
    {
        $user_id = auth()->user()->id;
        $currentUser = $this->userRepo->find($user_id);
        if ($request->all() === []) {
            return response(['message' => 'Nothing to update'], Response::HTTP_BAD_REQUEST);
        }
        $attributes = [
            'phone' => $request->get('phone') ?? $currentUser->phone,
            'location_id' => $request->get('location_id') ?? $currentUser->location_id,
            'birthday' => $request->get('birthday') ?? $currentUser->birthday,
            'name' => $request->get('name') ?? $currentUser->name,
        ];
        if ($this->userRepo->update($user_id, $attributes)) {
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
