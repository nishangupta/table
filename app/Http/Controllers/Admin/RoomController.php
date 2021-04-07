<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Product;
use App\Models\RoomType;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    public function index(){
        $rooms = Room::with('roomType')->latest()->get();
        return view('admin.room.index',compact('rooms'));
    }

    public function create(){
        $roomTypes = RoomType::all();
        return view('admin.room.create',compact('roomTypes'));
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|unique:rooms',
            'rate'=>'required',
            'description'=>'sometimes',
            'room_type_id'=>'required',
        ]);

        Room::create([
            'name'=>$request->name,
            'rate'=>$request->rate,
            'description'=>$request->description,
            'room_type_id'=>$request->room_type_id,
            'is_reserved'=>$request->is_reserved,
        ]);

        return redirect()->route('room.index')->with('success','Room created!');
    }
    
    public function show(Room $room){
        $reservations = Reservation::where('room_id',$room->id)->latest()->take(500)->get();

        $reservation = $reservations->first();
        $start = Carbon::parse($reservation->checkout.' '.$reservation->checkout_time);
        $end = Carbon::parse(today());
        $days = $end->diffInDays($start);

        if($days == 0){
            $days = 1; 
        }
        if($reservation->checkout_time > 11){
            $days = $days +1;
        }

        return view('admin.room.show',compact('room','reservations','days'));
    }

    public function edit(Room $room){
        $roomTypes = RoomType::all();
        $room->load('roomType');
        return view('admin.room.edit',compact('room','roomTypes'));
    }

    public function update(Request $request,Room $room){
        $request->validate([
            'name'=>'required|unique:rooms,name,'.$room->id,
            'rate'=>'required',
            'description'=>'sometimes',
            'room_type_id'=>'required',
        ]);

        $room->update([
            'name'=>$request->name,
            'rate'=>$request->rate,
            'description'=>$request->description,
            'room_type_id'=>$request->room_type_id,
            'is_reserved'=>$request->is_reserved,
        ]);
        
        return redirect(route('room.index'))->with('success','Room updated!');
    }
    
    public function destroy(Room $room){
        $room->delete();
        return redirect()->route('room.index')->with('success','Room deleted');
    }

    public function filter(Request $request){
        if($request->datepicker){
            $data = explode('-',$request->datepicker);
            $start = Carbon::parse($data[0]);
            $end = Carbon::parse($data[1]);
            
            $rooms = Room::whereBetween('created_at',[$start,$end])->get();
        }else{
            $rooms = Room::whereDay('created_at',Carbon::today())->get();
        }
        
        return view('admin.room.index',compact('rooms'));
    }
}
