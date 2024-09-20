<?php

namespace App\Http\Controllers;

use App\Enums\KothaStatusEnum;
use App\Utilities\ApiResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboardStats()
    {
        $totalKothas = \App\Models\Kotha::count();
        $totalPendingKothas = \App\Models\Kotha::where('status', KothaStatusEnum::PENDING->value)->count();
        $totalRejectedKothas = \App\Models\Kotha::where('status', KothaStatusEnum::REJECTED->value)->count();
        $totalUsers = \App\Models\User::count();

        return ApiResponse::ok([
            'usersCount' => $totalUsers,
            'kothCount' => $totalKothas,
            'pendingPostsCount' => $totalPendingKothas,
            'rejectedPostsCount' => $totalRejectedKothas,
        ]);
    }
}
