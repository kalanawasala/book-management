<?php

namespace Modules\V1\Http\Controllers;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Modules\V1\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Modules\V1\Http\Requests\User\CreateUserRequest;
use Modules\V1\Http\Requests\User\LoginUserRequest;

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
        $this->middleware('auth:api', ['except' => ['login']]);
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

            if (! $token = JWTAuth::attempt($credentials)) {

                return response()->json(['success' => false, 'errors' => 'Invalid username and Password'], 401);
            }

            $user = JWTAuth::user();
            // (optional) Attach the role to the token.
            // $token = JWTAuth::claims(['role' => $user->role])->fromUser($user);
            $token = JWTAuth::fromUser($user);
            return $this->respondWithToken($token);
        } catch (JWTException $e) {
            return response()->json(['success' => false, 'error' => 'Could not Create token'], 500);
        }
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            JWTAuth::Invalidate(JWTAuth::getToken());

            return response()->json(['success' => true, 'message' => 'user Successfully logged out'], 200);
        } catch (JWTException $e) {
            return response()->json(['success' => false, 'error' => 'Invalid token'], 400);
        }
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $token = JWTAuth::refresh(JWTAuth::getToken());
        return $this->respondWithToken($token->refresh(true, true));
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
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ], 200);
    }

    public function protectedEndpoint(CreateUserRequest $request)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['error' => 'Token expired'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error' => 'Invalid token'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'Token is missing'], 401);
        }

        // Access user data or perform actions requiring authentication
        return response()->json(['message' => 'Success! You are authorized.']);
    }
}
