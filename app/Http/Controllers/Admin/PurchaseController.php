<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class PurchaseController extends Controller
{
    public function index(){
        $purchases = Purchase::with('product')->latest()->get();
        return view('admin.purchase.index',compact('purchases'));
    }

    public function create(){
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('admin.purchase.create',compact('products','suppliers'));
    }

    public function store(Request $request){
        $request->validate([
            'cost_price'=>'required',
            'qty'=>'required|integer',
            'description'=>'nullable',
            'product_id'=>'required',
            'supplier_id'=>'required'
        ]);

        $purchase = Purchase::create([
            'cost_price'=>$request->cost_price,
            'product_id'=>$request->product_id,
            'supplier_id'=>$request->supplier_id,
            'qty'=>$request->qty,
            'description'=>$request->description,
        ]);

        $product = Product::whereKey($request->product_id)->first();
        $product->cost_price = $request->cost_price;
        
        switch($product->type){
            case "percent":
                $price = $request->cost_price + ($product->margin / 100) * $request->cost_price;
                break;

            default:
                $price = $request->cost_price + $product->margin;
        }

        if($product->tax_type == 'excluded'){
            $price += (13 / 100) * $request->cost_price; //adding 13 percent tax in cost price
        }
        
        $product->price = $price;
        $product->qty +=$request->qty;
        $product->save();

        return redirect()->route('purchase.index')->with('success','Purchase created!');
    }
    
    public function show(Purchase $purchase){
        return view('admin.purchase.show',compact('purchase'));
    }

    public function destroy(Purchase $purchase){
        $purchase->delete();
        return redirect()->route('purchase.index')->with('success','Purchase deleted');

    }

    public function filter(Request $request){
        if($request->datepicker){
            $data = explode('-',$request->datepicker);
            $start = Carbon::parse($data[0]);
            $end = Carbon::parse($data[1]);
            
            $purchases = Purchase::whereBetween('created_at',[$start,$end])->get();
        }else{
            $purchases = Purchase::whereDay('created_at',Carbon::today())->get();
        }
        
        return view('admin.purchase.index',compact('purchases'));
    }
}
