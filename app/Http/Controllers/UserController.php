<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Utilities\ApiResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): ApiResponse
    {
        $users = User::paginate(10);
        return ApiResponse::ok($users);
    }

    public function show($id): ApiResponse
    {
        $user = User::find($id);

        if (!$user) {
            return ApiResponse::notFound('user not found');
        }
        return ApiResponse::ok($user);
    }
}
