<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialOffer extends Model
{
    /** @use HasFactory<\Database\Factories\SpecialOfferFactory> */
    use HasFactory;

    protected $fillable = ['category_id', 'title', 'description'];

    public function category() {
        return $this->belongsTo(SpecialOfferCategory::class);
    }

    public function images() {
        return $this->morphMany(Image::class, 'imageable');
    }
}
