<?php

namespace App\Http\Controllers\Admin;

use App\Models\Food;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FoodController extends Controller
{
    public function index(){
        $foods = Food::with('menu')->get();
        return view('admin.food.index',compact('foods'));
    }

    public function create(){
        $menus = Menu::all();
        return view('admin.food.create',compact('menus'));
    }

    public function store(Request $request){
        $request->validate([
            'title'=>'required|min:3|unique:foods',
            'price'=>'required',
            'menu_id'=>'required',
            'unit'=>'',
        ]);

        $food = Food::create([
            'title'=>$request->title,
            'price'=>$request->price,
            'menu_id'=>$request->menu_id,
            'unit'=>$request->unit,
        ]);

        return redirect()->route('food.index')->with('success','Food created!');
    }
    
    public function show($food){
        $food = Food::whereKey($food)->with('menu')->first();
        return view('admin.food.show',compact('food'));
    }

    public function search(Request $request){
        $foods = Food::where('title','LIKE','%'.$request->term.'%')->get();
        return $foods;
    }

    public function edit(Food $food){
        $menus = Menu::all();
        return view('admin.food.edit',compact('food','menus'));
    }

    public function update(Request $request,Food $food){
        $request->validate([
            'title'=>'required|min:3|unique:foods,title,'.$food->id,
            'price'=>'required',
            'menu_id'=>'required',
            'unit'=>'',
        ]);

        $food->update([
            'title'=>$request->title,
            'price'=>$request->price,
            'menu_id'=>$request->menu_id,
            'unit'=>$request->unit,
        ]);
        
        return redirect(route('food.index'))->with('success','Food updated!');
    }
    
    public function destroy(Food $food){
        $food->delete();
        return redirect()->route('food.index')->with('success','Food deleted');
    }
}
