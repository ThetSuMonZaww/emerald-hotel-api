<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FAQResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'faq_category_name' => $this->faq_category->faq_category_name,
            'faq_question' => $this->faq_question,
            'faq_answer' => $this->faq_answer
        ];
    }
}
