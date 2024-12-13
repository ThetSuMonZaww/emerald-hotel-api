<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Response;
use App\Helpers\ResponseHelper;
use App\Http\Resources\FAQResource;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = FAQ::paginate(10);
        $meta = ['total_count' => $faqs->total(),
            'current_page' => $faqs->currentPage(),
            'per_page' => $faqs->perPage(),
            'last_page' => $faqs->lastPage()];
        return ResponseHelper::success(200, 'Success', FAQResource::collection($faqs), $meta);
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
            'faq_category_id' => 'required',
            'faq_question' => 'required',
            'faq_answer' => 'required'
        ]);

        $faq = FAQ::create([
            'faq_category_id' => $request->faq_category_id,
            'faq_question' => $request->faq_question,
            'faq_answer' => $request->faq_answer
        ]);

        return ResponseHelper::success(200, 'Addnew Successfully', $faq);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $faq = FAQ::find($id);
        if(!$faq){
            return ResponseHelper::fail(404, 'Content Not Found');
        }
        else{
            return ResponseHelper::success(200, 'Success', new FAQResource($faq));
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
        $faq = FAQ::find($id);
        if($faq){
            $faq->faq_category_id = $request->faq_category_id;
            $faq->faq_question = $request->faq_question;
            $faq->faq_answer = $request->faq_answer;
            $faq->update();
            return ResponseHelper::success(200, 'Update Successfully', $faq);
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
        $faq = FAQ::find($id);
        if($faq){
            $faq->delete();
            return ResponseHelper::success(200, 'Delete Successfully', $faq);
        }
        else{
            return ResponseHelper::fail(404, 'Content Not Found');
        }
    }
}
