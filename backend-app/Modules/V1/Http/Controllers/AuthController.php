<?php

namespace Modules\V1\Http\Controllers;

use Modules\V1\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Modules\V1\Http\Requests\User\CreateUserRequest;
use Modules\V1\Http\Requests\User\LoginUserRequest;
use Illuminate\Database\Eloquent\Factory;
use Modules\V1\Entities\User;

class AuthController extends Controller
{
    protected $userRepository;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->userRepository = $userRepository;
    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginUserRequest $request)
    {

        $credentials = $request->only(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['success' => false, 'errors' => 'Invalid username and Password'], 401);
        }

        $token = auth('api')->attempt($credentials);

        return $this->respondWithToken($token);
    }


    public function register(CreateUserRequest $request)
    {
        try {
            $user = $this->userRepository->createUser($request);

            $token = Auth::login($user);
            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'data' => $user,
                'authorization' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'error' => ['invalid user credentials']
            ], 400);
        }
    }


    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'success' => true,
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => '3600s'
        ]);
    }
}
