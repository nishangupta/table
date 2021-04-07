<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(){
        $products = Product::with('productCategory')->latest()->get();
        return view('admin.product.index',compact('products'));
    }

    public function create(){
        $categories = ProductCategory::all();
        return view('admin.product.create',compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'title'=>'required|min:3|unique:products',
            'description'=>'nullable',
            'cost_price'=>'required',
            'product_category_id'=>'required',
            'qty'=>'required',
            'type'=>'required',
            'margin'=>'required',
            'minimum'=>'required',
        ]);

        switch($request->type){
            case "fixed":
                $price = $request->cost_price + $request->margin;
                break;
            case "percent":
                $price = $request->cost_price + ($request->margin / 100) * $request->cost_price;
                break;

            default:
                $price = $request->cost_price + $request->margin;
        }

        if($request->tax_type == 'excluded'){
            $price += (13 / 100) * $request->cost_price; //adding 13 percent tax in cost price
        }

        $product = Product::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'cost_price'=>$request->cost_price,
            'price'=>$price, //selling price
            'product_category_id'=>$request->product_category_id,
            'qty'=>$request->qty,
            'type'=>$request->type,
            'margin'=>$request->margin,
            'tax_type'=>$request->tax_type,
            'minimum'=>$request->minimum,
        ]);

        return redirect()->route('product.show',$product->id)->with('success','Product created!');
    }
    
    public function show($product){
        $product = Product::whereKey($product)->with('productCategory')->first();
        return view('admin.product.show',compact('product'));
    }

    //searching for product
    public function search(Request $request){
        $products = Product::where('title','LIKE','%'.$request->term.'%')->get();
        return $products;
    }

    public function edit(Product $product){
        $categories = ProductCategory::all();
        return view('admin.product.edit',compact('product','categories'));
    }

    public function update(Request $request,Product $product){
        $request->validate([
            'title'=>'required|min:3|unique:products,title,'.$product->id,
            'description'=>'nullable',
            'cost_price'=>'required',
            'product_category_id'=>'required',
            'qty'=>'required',
            'type'=>'required',
            'margin'=>'required',
            'minimum'=>'required',
        ]);

        switch($request->type){
            case "fixed":
                $price = $request->cost_price + $request->margin;
                break;
            case "percent":
                $price = $request->cost_price + ($request->margin / 100) * $request->cost_price;
                break;

            default:
                $price = $request->cost_price + $request->margin;
        }

        if($request->tax_type == 'excluded'){
            $price += (13 / 100) * $request->cost_price; //adding 13 percent tax in cost price
        }

        $product->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'cost_price'=>$request->cost_price,
            'price'=>$price,
            'product_category_id'=>$request->product_category_id,
            'qty'=>$request->qty,
            'type'=>$request->type,
            'margin'=>$request->margin,
            'tax_type'=>$request->tax_type,
            'minimum'=>$request->minimum,
        ]);
        
        return redirect(route('product.index'))->with('success','Product updated!');
    }
    
    public function destroy(Product $product){
        $product->delete();
        return redirect()->route('product.index')->with('success','Product deleted');
    }
}
