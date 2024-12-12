<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\SpecialOfferCategory;
use App\Http\Requests\StoreSpecialOfferCategoryRequest;
use App\Http\Requests\UpdateSpecialOfferCategoryRequest;
use Illuminate\Support\Facades\Validator;

class SpecialOfferCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialOfferCategories = SpecialOfferCategory::all();
        if($specialOfferCategories->isEmpty()) {
            return ResponseHelper::fail(404, 'Not Found');
        }
        return ResponseHelper::success(200, 'success', $specialOfferCategories);
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
    public function store(StoreSpecialOfferCategoryRequest $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $specialOfferCategory = SpecialOfferCategory::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return ResponseHelper::success(200, 'successfully stored', $specialOfferCategory);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $specialOfferCategory = SpecialOfferCategory::find($id);
        if(!$specialOfferCategory) {
            return ResponseHelper::fail(404, 'Not Found');
        }
        return ResponseHelper::success(200, 'success', $specialOfferCategory);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SpecialOfferCategory $specialOfferCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpecialOfferCategoryRequest $request, SpecialOfferCategory $specialOfferCategory)
    {

        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $specialOfferCategory->update([
            'title' => $request->title,
            'description' => $request->description
        ]);
        return ResponseHelper::success(200, 'successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SpecialOfferCategory $specialOfferCategory)
    {
        if($specialOfferCategory) {
            $specialOfferCategory->delete();
        }
        return ResponseHelper::success(200, 'successfully deleted');
    }
}
