<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';

    protected $fillable = [
        'room_type',
        'room_number',
        'room_description',
        'service',
        'special',
        'bed_type',
        'size',
        'adult',
        'child',
        'bathroom',
        'view',
        'price',
        'status',
    ];

    public function images()
    {
        return $this-> morphMany(Image::class, 'imageable');
    }
}
