<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    protected $table = "faq";
    protected $fillable = [
        'faq_category_id',
        'faq_question',
        'faq_answer'
    ];
    public function faq_category(){
        return $this->belongsTo(FAQ_Category::class);
    }
}
