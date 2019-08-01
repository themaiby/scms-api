<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\ItemResponse;
use Auth;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'refresh']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only([
            LoginRequest::FIELD_EMAIL,
            LoginRequest::FIELD_PASSWORD
        ]);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['message' => __('auth.failed')], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return ItemResponse
     * @throws Exception
     */
    public function me(): ItemResponse
    {
        $user = Auth::user();
        if ($user) {
            $res = array_merge($user->toArray(), [
                'permissions' => $user->getAllPermissions()
            ]);
            return new ItemResponse($res);
        }

        throw new AuthenticationException();
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
