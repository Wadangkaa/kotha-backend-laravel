<?php

namespace App\Http\Controllers;

use App\Http\Resources\RentalFloorResource;
use App\Models\RentalFloor;
use App\Http\Requests\StoreRentalFloorRequest;
use App\Http\Requests\UpdateRentalFloorRequest;
use App\Utilities\ApiResponse;

class RentalFloorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $floors = RentalFloor::all();
        return ApiResponse::ok(RentalFloorResource::collection($floors));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRentalFloorRequest $request)
    {
        $floor = RentalFloor::create([
            'floor' => $request->floor
        ]);

        return ApiResponse::created(RentalFloorResource::make($floor));
    }

    /**
     * Display the specified resource.
     */
    public function show(RentalFloor $rentalFloor)
    {
        return ApiResponse::ok(RentalFloorResource::make($rentalFloor));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RentalFloor $rentalFloor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRentalFloorRequest $request, RentalFloor $rentalFloor)
    {
        $rentalFloor->update($request->validated());
        return ApiResponse::ok(RentalFloorResource::make($rentalFloor));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RentalFloor $rentalFloor)
    {
        //
    }
}
