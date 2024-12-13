<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\RoomBooking;
use Illuminate\Http\Request;

class RoomBookingController extends Controller
{
    public function index() {
        $roomBookings = RoomBooking::all();
        if($roomBookings->isEmpty()) {
            return ResponseHelper::fail(404, 'Not Found');
        }
        return ResponseHelper::success(200, 'success', $roomBookings);
    }
}
