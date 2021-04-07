<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function index(){
        $menus = Menu::latest()->get();
        return view('admin.menu.index',compact('menus'));
    }

    public function create(){
        return view('admin.menu.create');
    }

    public function store(Request $request){
        $request->validate([
            'title'=>'required|min:3',
        ]);

        $menu = Menu::create([
            'title'=>$request->title,
        ]);
        
        return redirect(route('menu.index'))->with('success','Menu created!');
    }

    public function show(Menu $menu){
        return view('admin.menu.show',compact('menu'));
    }

    public function edit(Menu $menu){
        return view('admin.menu.edit',compact('menu'));
    }

    public function update(Request $request,Menu $menu){
        $request->validate([
            'title'=>'required|min:3',
        ]);

        $menu->update([
            'title'=>$request->title,
        ]);

        return redirect(route('menu.index'))->with('success','Menu updated!');
    }
    
    public function destroy(Menu $menu){
        $menu->delete();

        return redirect()->route('menu.index')->with('success','Menu deleted');

    }

}
