<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Resources\FAQ_CategoryResource;
use Illuminate\Http\Request;
use App\Models\FAQ_Category;

class FAQ_CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faq_categories = FAQ_Category::paginate(10);
        $meta = ['total_count' => $faq_categories->total(),
                'current_page' => $faq_categories->currentPage(),
                'per_page' => $faq_categories->perPage(),
                'last_page' => $faq_categories->lastPage()];
        return ResponseHelper::success(200, 'Success', FAQ_CategoryResource::collection($faq_categories), $meta);
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
    public function store(Request $request)
    {
        $request->validate([
            'faq_category_name' => 'required',
            'faq_category_description' => 'required'
        ]);

        // $faq_category = new FAQ_Category();
        // $faq_category->faq_category_name = $request->faq_category_name;
        // $faq_category->faq_category_description = $request->faq_category_description;
        // $faq_category->save();

        $faq_category = FAQ_Category::create([
            'faq_category_name' => $request->faq_category_name,
            'faq_category_description' => $request->faq_category_description
        ]);

        return ResponseHelper::success(200, 'Addnew Successfully', $faq_category);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // return $id;
        $faq_category = FAQ_Category::find($id);
        if(!$faq_category){
            return ResponseHelper::fail(404, 'Content Not Found');
        }
        else{
            return ResponseHelper::success(200, 'Success', new FAQ_CategoryResource($faq_category));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return $request;
        $faq_category = FAQ_Category::find($id);
        if($faq_category){
            $faq_category->faq_category_name = $request->faq_category_name;
            $faq_category->faq_category_description = $request->faq_category_description;
            $faq_category->update();
            return ResponseHelper::success(200, 'Update Successfully', $faq_category);
        }
        else{
            return ResponseHelper::fail(404, 'Content Not Found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faq_category = FAQ_Category::find($id);
        if($faq_category){
            $faq_category->delete();
            return ResponseHelper::success(200, 'Delete Successfully', $faq_category);
        }
        else{
            return ResponseHelper::fail(404, 'Content Not Found');
        }
    }
}
