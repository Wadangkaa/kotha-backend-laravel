<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Utilities\ApiResponse;

class UserController extends Controller
{
    public function index(): ApiResponse
    {
        $users = User::paginate(10);
        return ApiResponse::ok(UserResource::collection($users));
    }

    public function show(User $user): ApiResponse
    {
        return ApiResponse::ok(UserResource::make($user));
    }
}
