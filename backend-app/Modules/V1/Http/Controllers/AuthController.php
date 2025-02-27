<?php

namespace Modules\V1\Http\Controllers;

use Modules\V1\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Modules\V1\Http\Requests\User\CreateUserRequest;
use Modules\V1\Http\Requests\User\LoginUserRequest;
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
            return $this->respondWithToken($token);
        } catch (\Exception $e) {

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
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh(true, true));
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
            'message' => 'Token Generated Successfully',
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ], 200);
    }
}
