<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

/**
 * @group Admin account management
 *
 * APIs for managing admin account
 */
class AuthController extends Controller
{

    
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**
     
     * 
     * 
     * Login and get a JWT via given credentials.
     * 
     
     * @bodyParam email string required The email of the admin. Example:mohamed@test.com
     * @bodyParam password string required The password name of the admin. Example: dalzkjlk
     * @response {
     *  "access_token": "eyJ0eXAiOi",
     *  "token_type": "bearer",
     *  "expires_in": 3600,
     *  "user": {"id": 1,"name": "user1","email": "mohamed@test.com","email_verified_at": null,"created_at": "2019-11-27 00:49:25","updated_at": "2019-11-27 00:49:25"}
     * }
     * @response 401{"message": "Wrong email or password"}
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'Wrong email or password'], 401);
        }

        return $this->respondWithToken($token);
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
     * 
     * @authenticated
     * @bodyParam token string required The token of the admin. Example:lmkfmelzkf
     * Log the user out (Invalidate the token).
     * @response {"message": "Successfully logged out"}
     * @response 401 {
     *  "message": "Unauthenticated"
     * }
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Register a new Administrator(Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register()
    {
        User::create([
            'name'=>request('name'),
            'email'=>request('email'),
            'password'=>Hash::make(request('password')),
        ]);

        return $this->login(request());
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
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
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
