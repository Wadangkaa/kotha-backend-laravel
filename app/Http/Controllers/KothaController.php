<?php

namespace App\Http\Controllers;

use App\Http\Resources\KothaResource;
use App\Models\Kotha;
use App\Http\Requests\StoreKothaRequest;
use App\Http\Requests\UpdateKothaRequest;
use App\Utilities\ApiResponse;

class KothaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kothas = Kotha::with(['category'])
            ->orderBy('id', 'desc')
            ->paginate(25);
        return ApiResponse::ok(KothaResource::collection($kothas));
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
    public function store(StoreKothaRequest $request)
    {
        $kotha = Kotha::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'negotiable' => $request->negotiable,
            'purpose' => $request->purpose,
        ]);

        return ApiResponse::created(KothaResource::make($kotha));
    }

    /**
     * Display the specified resource.
     */
    public function show(Kotha $kotha)
    {
        return ApiResponse::ok(KothaResource::make($kotha));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kotha $kotha)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKothaRequest $request, Kotha $kotha)
    {
        $kotha->update($request->validated());
        return ApiResponse::ok(KothaResource::make($kotha), 'Kotha updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kotha $kotha)
    {
        //
    }
}
