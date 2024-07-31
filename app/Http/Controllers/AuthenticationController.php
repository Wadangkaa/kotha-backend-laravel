<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Utilities\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function register(UserRegisterRequest $request): ApiResponse
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return ApiResponse::created(UserResource::make($user), 'user registered');
    }
}
