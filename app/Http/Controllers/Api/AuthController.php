<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //TODO: Apply rate limiter to avoid attacks and lockout accounts for sometime. This would be a nice addition later
    //TODO: add a method to revoke all prev tokens maybe ?

    public function getToken(LoginRequest $request)
    {
        $data = $request->validated();
        try {
            $credentials = request(['email', 'password']);

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'error' => 'failure',
                    'message' => 'Invalid credentials',
                ], 500);
            }

            $user = User::where('email', $data['email'])->first();
            if (!Hash::check($request->password, $user->password, [])) {
                throw new Exception('Login Error');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'error' => null,
                'message' => 'Successfully logged in, pass this access_token on all subsequent calls',
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'error' => $error,
                'message' => 'Login Error',
            ], 500);
        }
    }
}
