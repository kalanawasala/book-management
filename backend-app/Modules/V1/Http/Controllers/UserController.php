<?php

namespace Modules\V1\Http\Controllers;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Modules\V1\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Modules\V1\Http\Requests\User\CreateUserRequest;
use Illuminate\Support\Facades\Gate;
use Modules\V1\Entities\User;

class UserController extends Controller
{
    protected $userRepository;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * Update the given post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Modules\V1\Entities\User  $user
     * @return \Illuminate\Http\Response
     */

    public function createUser(CreateUserRequest $request)
    {
        if (! Gate::allows('create_user')) {
            abort(403);
        }
        try {
            $user = $this->userRepository->createUser($request);
            $token = JWTAuth::login($user);
            return $this->respondWithToken($token);
        } catch (JWTException $e) {

            return response()->json([
                'success' => false,
                'error' => ['invalid user credentials']
            ], 400);
        }
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser()
    {
        if (! Gate::allows('get_users')) {
            abort(403);
        }
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'User not found'], 404);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Invalid token'], 400);
        }
        return response()->json(JWTAuth::user($user));
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'success' => true,
            'message' => 'Token Generated Successfully',
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ], 200);
    }
}
