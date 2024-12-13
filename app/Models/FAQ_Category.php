<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FAQ_Category extends Model
{
    protected $table = 'faq_categories';
    protected $fillable = [
        'faq_category_name', 'faq_category_description'
    ];

    public function faq(){
        return $this->hasMany(FAQ::class);
    }
}
