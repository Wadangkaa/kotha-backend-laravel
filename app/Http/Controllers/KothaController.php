<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactResource;
use App\Http\Resources\KothaDetailResource;
use App\Http\Resources\KothaResource;
use App\Models\Kotha;
use App\Http\Requests\StoreKothaRequest;
use App\Http\Requests\UpdateKothaRequest;
use App\Utilities\ApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
        DB::beginTransaction();
        $kotha = Kotha::create($request->validated());
        $kotha->facility()->create($request->validated());
        $kotha->contact()->create($request->all());
        DB::commit();

        return ApiResponse::created(KothaResource::make($kotha));
    }

    /**
     * Display the specified resource.
     */
    public function show(Kotha $kotha)
    {
        return ApiResponse::ok(KothaDetailResource::make($kotha));
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

    public function searchKothaInMap(Request $request)
    {
        $contacts = \App\Models\Contact::withinRadius($request->center['lat'], $request->center['lng'], $request->radius)
            ->get();
        return ApiResponse::ok(ContactResource::collection($contacts));
    }
}
