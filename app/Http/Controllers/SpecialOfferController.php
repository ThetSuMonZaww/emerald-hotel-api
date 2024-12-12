<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\SpecialOffer;
use App\Http\Requests\StoreSpecialOfferRequest;
use App\Http\Requests\UpdateSpecialOfferRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SpecialOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialOffers = SpecialOffer::with('images')->get();
        if($specialOffers->isEmpty()) {
            return ResponseHelper::fail(404, 'Not Found');
        }
        return ResponseHelper::success(200, 'success', $specialOffers);
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
    public function store(StoreSpecialOfferRequest $request)
    {
        $validator = Validator::make($request->all(),[
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'images' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $specialOffer = SpecialOffer::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description
        ]);


        if($request->hasFile('images')) {
            $images = [];
            foreach($request->file('images') as $image) {
                $newName = 'ItemImage'. uniqid(). '.'. $image->extension();
                $image->storeAs('public/offerImg', $newName);
                $images[] = $newName;

                $specialOffer->images()->create([
                    'image' => json_encode($images)
                ]);
            }
        }

        return ResponseHelper::success(200, 'successfully stored', $specialOffer);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $specialOffer = SpecialOffer::with('images')->find($id);
        if(!$specialOffer) {
            return ResponseHelper::fail(404, 'Not Found');
        }
        return ResponseHelper::success(200, 'success', $specialOffer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SpecialOffer $specialOffer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpecialOfferRequest $request, SpecialOffer $specialOffer)
    {

        $validator = Validator::make($request->all(),[
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'images' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $specialOffer->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description
        ]);

        foreach($specialOffer->images as $image) {
            Storage::delete('public/offerImg/'. $image->image);
            $image->delete();
        }

        if($request->hasFile('images')) {
            $images = [];
            foreach($request->file('images') as $image) {
                $newName = 'ItemImage'. uniqid(). '.'. $image->extension();
                $image->storeAs('public/offerImg', $newName);
                $images[] = $newName;

                $specialOffer->images()->create([
                    'image' => json_encode($images)
                ]);
            }
        }

        return ResponseHelper::success(200, 'successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SpecialOffer $specialOffer)
    {
        if($specialOffer) {
            foreach($specialOffer->images as $image) {
                Storage::delete('public/offerImg/'. $image->image);
                $image->delete();
            }
            $specialOffer->delete();
        }
        return ResponseHelper::success(200, 'successfully deleted');
    }
}
