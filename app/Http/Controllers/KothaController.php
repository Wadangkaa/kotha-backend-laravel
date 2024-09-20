<?php

namespace App\Http\Controllers;

use App\Enums\KothaPurposeEnum;
use App\Http\Resources\ContactResource;
use App\Http\Resources\KothaDetailResource;
use App\Http\Resources\KothaResource;
use App\Models\Kotha;
use App\Http\Requests\StoreKothaRequest;
use App\Http\Requests\UpdateKothaRequest;
use App\Services\RecommendationService;
use App\Utilities\ApiResponse;
use App\Utilities\ImageUploader;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

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
        $kotha = Kotha::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category,
            'district_id' => $request->district,
            'price' => $request->price,
            'negotiable' => $request->negotiable,
            'purpose' => $request->purpose,
            'user_id' => auth()->id()
        ]);
        foreach ($request->images as $key => $image) {
            $path = ImageUploader::upload($image, 'kotha');
            $kotha->images()->create(['image_url' => $path]);
        }
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
        $kotha->delete();
        return ApiResponse::ok([], 'Kotha deleted successfully');
    }

    public function searchKothaInMap(Request $request)
    {
        $contacts = \App\Models\Contact::withinRadius($request->center['lat'], $request->center['lng'], $request->radius)
            ->get();
        return ApiResponse::ok(ContactResource::collection($contacts));
    }

    public function authUserKotha(Request $request)
    {
        $kothas = Kotha::where('user_id', auth()->id())->latest()->paginate(10);
        return ApiResponse::ok(KothaResource::collection($kothas));
    }

    public function recommendation(Request $request)
    {
        $request->validate([
            'category' => 'required|exists:categories,id',
            'district' => 'required|exists:nepal_addresses,id',
            'kitchen' => 'required|in:1,0',
            'max_price' => 'required|numeric',
            'min_price' => 'required|numeric',
            'negotiable' => 'required|in:1,0',
            'parking' => 'required|in:1,0',
            'purpose' => ['required', new Enum(KothaPurposeEnum::class)],
            'water_facility' => 'required|in:1,0'
        ]);
        $recommendationService = new RecommendationService($request->toArray());
        $recommendatedRooms = $recommendationService->recommendedRooms(5);

        return ApiResponse::ok(KothaResource::collection($recommendatedRooms));
    }
}
