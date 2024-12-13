<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialOfferCategory extends Model
{
    /** @use HasFactory<\Database\Factories\SpecialOfferCategoryFactory> */
    use HasFactory;

    protected $fillable = ['title', 'description'];

    public function offers() {
        return $this->hasMany(SpecialOffer::class);
    }
}
