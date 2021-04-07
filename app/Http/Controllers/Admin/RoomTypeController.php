<?php

namespace App\Http\Controllers\Admin;

use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomTypeController extends Controller
{
    public function index(){
        $roomTypes = RoomType::all();
        return view('admin.room-type.index',compact('roomTypes'));
    }

    public function create(){
        return view('admin.room-type.create');
    }

    public function store(Request $request){
        $request->validate([
            'title'=>'required',
        ]);

        RoomType::create([
            'title'=>$request->title
        ]);

        return redirect()->route('roomType.index')->with('success','Room Type created!');
    }
    
    public function show(RoomType $roomType){
        return view('admin.room-type.show',compact('roomType'));
    }

    public function edit(RoomType $roomType){
        return view('admin.room-type.edit',compact('roomType'));
    }

    public function update(Request $request,RoomType $roomType){
        $request->validate([
            'title'=>'required',
        ]);

        $roomType->update([
            'title'=>$request->title
        ]);
        
        return redirect(route('roomType.index'))->with('success','Room Type updated!');
    }
    
    public function destroy(RoomType $roomType){
        $roomType->delete();
        return redirect()->route('roomType.index')->with('success','Room Type deleted');
    }
}
