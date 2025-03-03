<?php

namespace Modules\V1\Http\Controllers;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
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
        $this->middleware('auth:api', ['except' => ['login', 'register', 'logout', 'me']]);
        $this->userRepository = $userRepository;
    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginUserRequest $request)
    {
        try {

            $credentials = $request->only(['email', 'password']);

            if (! $token = auth()->attempt($credentials)) {
                return response()->json(['success' => false, 'errors' => 'Invalid username and Password'], 401);
            }

            $token = auth('api')->attempt($credentials);

            return $this->respondWithToken($token);
        } catch (JWTException $e) {
            return response()->json(['success' => false, 'error' => 'Could not Create token'], 500);
        }
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

        return response()->json(['success' => true, 'message' => 'user Successfully logged out'], 200);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh(true, true));
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
