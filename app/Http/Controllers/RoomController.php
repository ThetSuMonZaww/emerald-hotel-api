<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\RoomResource;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::paginate(10);
        $meta = [
            'total_count' => $rooms->total(),
            'current_page' => $rooms->currentPage(),
            'last_page' => $rooms->lastPage(),
            'per_page' => $rooms->perPage()
        ];

        return ResponseHelper::success(200, 'Success', RoomResource::collection($rooms), $meta);
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
        // return $request->images;
        $request->validate([
            'room_type' => 'required',
            'room_number' => 'required',
            'room_description' => 'required',
            'service' => 'required',
            'special' => 'required',
            'bed_type' => 'required',
            'size' => 'required',
            'adult' => 'required',
            'child' => 'required',
            'bathroom' => 'required',
            'view' => 'required',
            'price' => 'required',
        ]);

        DB::beginTransaction();
        try
        {
            $room = Room::create([
                'room_type' => $request->room_type,
                'room_number' => $request->room_number,
                'room_description' => $request->room_description,
                'service' => $request->service,
                'special' => $request->special,
                'bed_type' => $request->bed_type,
                'size' => $request->size,
                'adult' => $request->adult,
                'child' => $request->child,
                'bathroom' => $request->bathroom,
                'view' => $request->view,
                'price' => $request->price,
                'status' => 'Available'
            ]);

            if($request->hasFile('images')) {
                // $images = [];
                foreach($request->file('images') as $image)
                {
                    $new_file = 'ItemImage'.uniqid().'.'.$image->extension();
                    $image->storeAs('RoomImages', $new_file);
                    $image = new Image(['image' => $new_file]);
                    $room->images()->save($image);
                }

                // return json_encode($images);

                // $image = new Image();
                // $image->image = json_encode($images);
                // $image->imageable_id = $room->id;
                // $image->imageable_type = 'App\Models\Room';
                // $image->save();
                //  $image1 = new Image(['image' => json_encode($images)]);
                //  return $image1;
                // $room->images()->save($image1);
            }

            DB::commit();
            return ResponseHelper::success(200, 'Room created successfully', $room);
        }
        catch (\Exception $e) {
            DB::rollBack();
            return ResponseHelper::fail(500, $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $room = Room::find($id);
        if(!$room) {
            return ResponseHelper::fail(404, 'Content Not Found');
        }
        else {
            return ResponseHelper::success(200, 'Success', new RoomResource($room));
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
        $room = Room::find($id);
        if($room){
            $room->room_type = $request->room_type;
            $room->room_number = $request->room_number;
            $room->room_description = $request->room_description;
            $room->service = $request->service;
            $room->special = $request->special;
            $room->bed_type = $request->bed_type;
            $room->size = $request->size;
            $room->adult = $request->adult;
            $room->child = $request->child;
            $room->bathroom = $request->bathroom;
            $room->view = $request->view;
            $room->price = $request->price;
            $room->update();
            return ResponseHelper::success(200, 'Update Successfully', $room);
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
        $room = Room::find($id);
        if($room){
            $room->delete();
            return ResponseHelper::success(200, 'Delete Successfully', $room);
        }
        else{
            return ResponseHelper::fail(404, 'Content Not Found');
        }
    }
}
