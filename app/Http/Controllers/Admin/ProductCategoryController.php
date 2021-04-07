<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class ProductCategoryController extends Controller
{
    public function index(){
        $categories = ProductCategory::all();
        return view('admin.product-category.index',compact('categories'));
    }

    public function create(){
        return view('admin.product-category.create');
    }

    public function store(Request $request){
        $request->validate([
            'title'=>'required|min:3',
        ]);

        $category = ProductCategory::create([
            'title'=>$request->title,
        ]);

        return redirect()->route('product-category.index')->with('success','Category created!');
    }
    
    public function edit(ProductCategory $productCategory){
        return view('admin.product-category.edit',compact('productCategory'));
    }

    public function show(ProductCategory $productCategory){
        $products = $productCategory->products()->latest()->paginate(15);
        return view('admin.product-category.show',compact('productCategory','products'));
    }

    public function update(Request $request,ProductCategory $productCategory){
        $request->validate([
            'title'=>'required|min:3',
        ]);

        $productCategory->update([
            'title'=>$request->title,
        ]);
        
        return redirect(route('product-category.index'))->with('success','category updated!');
    }
    
    public function destroy(ProductCategory $productCategory){
        $productCategory->delete();
        return redirect()->route('product-category.index')->with('success','category deleted');

    }
}
