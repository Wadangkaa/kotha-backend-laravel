<?php

namespace App\Http\Controllers;

use App\Utilities\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login(Request $request): ApiResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $check = Auth::attempt($request->only(['email', 'password']));
        if (!$check) {
            return ApiResponse::unauthorized('Invalid credentials provided');
        }
        return ApiResponse::ok(
            ['token' => Auth::user()->createToken('token')->plainTextToken],
            'Login in successful'
        );
    }

    public function profile(): ApiResponse
    {
        $user = auth()->user();
        return ApiResponse::ok($user);
    }

    public function logout(): ApiResponse
    {
        $user = auth()->user();
        $user->tokens()->delete();
        return ApiResponse::ok(null, 'logout successful');
    }
}
