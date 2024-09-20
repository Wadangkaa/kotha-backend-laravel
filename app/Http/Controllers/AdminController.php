<?php

namespace App\Http\Controllers;

use App\Enums\KothaStatusEnum;
use App\Http\Resources\KothaResource;
use App\Models\Kotha;
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

    public function getKothas()
    {
        $kothas = Kotha::with(['category'])
            ->orderBy('id', 'desc')
            ->paginate(25);
        return ApiResponse::ok(KothaResource::collection($kothas));
    }

    public function response(Request $request, Kotha $kotha)
    {
        $request->validate([
            'response' => 'required|in:1,0'
        ]);

        $status = $request->response == 1 ? KothaStatusEnum::APPROVED->value : KothaStatusEnum::REJECTED->value;
        $kotha->update([
            'status' => $status
        ]);

        return ApiResponse::ok([], 'Status updated successfully');
    }
}
