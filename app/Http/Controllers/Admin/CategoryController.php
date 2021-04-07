<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('admin.category.index',compact('categories'));
    }

    public function create(){
        return view('admin.category.create');
    }

    public function store(Request $request){
        $request->validate([
            'title'=>'required|min:3',
        ]);

        $category = Category::create([
            'title'=>$request->title,
        ]);

        return redirect()->route('category.index')->with('success','Category created!');
    }
    
    public function edit(Category $category){
        return view('admin.category.edit',compact('category'));
    }

    public function update(Request $request,Category $category){
        $request->validate([
            'title'=>'required|min:3',
        ]);

        $category->update([
            'title'=>$request->title,
        ]);
        
        return redirect(route('category.index'))->with('success','Category updated!');
    }
    
    public function destroy(Category $category){
        $category->delete();
        return redirect()->route('category.index')->with('success','Category deleted');

    }
}
