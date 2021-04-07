<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Customer;
use App\Models\SaleProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{
    public function index(){
        $sales = Sale::with('customer')->latest()->get();
        return view('admin.sale.index',compact('sales'));
    }

    public function create(){
        $customers= Customer::all();
        return view('admin.sale.create',compact('customers'));
    }

    public function store(Request $request){
        $request->validate([
            'qty.*'=>'required|gt:0',
            'customer_id'=>'required',
            'details'=>'nullable',
            'discount_amount'=>'max:191',
            'payment_type'=>'required',
            'chq_no'=>'required_if:payment_type,bank',
            'chq_date'=>'required_if:payment_type,bank',
        ]);

        if($request->paid_amount>0){
            $status = 1;
        }else{
            $status = 0;
        }

        $data = [
            'customer_id'=>$request->customer_id,
            'details'=>$request->details,
            'sub_total'=>$request->sub_total,
            'tax_rate'=>$request->tax_rate,
            'tax_amount'=>$request->tax_amount,
            'discount_rate'=>$request->discount_rate,
            'discount_amount'=>$request->discount_amount,
            'total_amount'=>$request->total_amount,
            'paid_amount'=>$request->paid_amount,
            'due_amount'=>$request->due_amount,
            'status'=>$status,
            'payment_type'=>$request->payment_type,
            'chq_no'=>$request->chq_no,
            'chq_date'=>$request->chq_date,
        ];

        $sale = Sale::firstOrCreate($data);

        if (!empty($request->title)) {
            foreach ($request->title as $key => $item) {
                if ($item != "" && 
                    $request->title[$key] != "" &&
                    $request->qty[$key] != "" &&
                    $request->price[$key] != "" &&
                    $request->total[$key] != ""
                ) {
                    $saleproduct = SaleProduct::create([
                        'sale_id' => $sale->id,
                        'title'=> $request->title[$key],
                        'qty' => $request->qty[$key],
                        'price' => $request->price[$key],
                        'total' => $request->total[$key],
                    ]);

                    $product = Product::where('title', $request->title[$key])->first();
                    $product->update([
                        'qty'=>$product->qty - $request->qty[$key]
                    ]);
                    // DB::table('products')->where('title', $request->title[$key])->decrement('qty', $request->qty[$key]);
                }
            }
        }

        return redirect()->route('sale.show',$sale->id)->with('success','Sale created!');
    }
    
    public function show($sale){
        $sale = Sale::whereKey($sale)->with('customer','saleProducts')->first();
        return view('admin.sale.show',compact('sale'));
    }

    public function edit($sale){
        $sale = Sale::whereKey($sale)->with('customer','saleProducts')->first();         
        $customers = Customer::all();
        return view('admin.sale.edit',compact('sale','customers'));
    }

    public function update(Request $request,$sale){

        $request->validate([
            'qty.*'=>'required|gt:0',
            'details'=>'nullable',
            'customer_id'=>'required',
            'discount_amount'=>'max:191',
            'payment_type'=>'required',
            'chq_no'=>'required_if:payment_type,bank',
            'chq_date'=>'required_if:payment_type,bank',
        ]);
       
        if($request->paid_amount>0){
            $status = 1;
        }else{
            $status = 0;
        }

        $data = [
            'customer_id'=>$request->customer_id,
            'details'=>$request->details,
            'sub_total'=>$request->sub_total,
            'tax_rate'=>$request->tax_rate,
            'tax_amount'=>$request->tax_amount,
            'discount_rate'=>$request->discount_rate,
            'discount_amount'=>$request->discount_amount,
            'total_amount'=>$request->total_amount,
            'paid_amount'=>$request->paid_amount,
            'due_amount'=>$request->due_amount,
            'status'=>$status,
            'payment_type'=>$request->payment_type,
            'chq_no'=>$request->chq_no,
            'chq_date'=>$request->chq_date,
        ];

        $sale = Sale::whereKey($sale)->with('saleProducts')->first();   

        foreach($sale->saleProducts as $p){
            $product = Product::where('title', $p->title)->first();
            $product->update([
                'qty'=>$product->qty + $p->qty,
            ]);

            $p->delete(); //deleting old relationship
        }

        $sale->update($data);

        if (!empty($request->title)) {
            foreach ($request->title as $key => $item) {
                if ($item != "" && 
                    $request->title[$key] != "" &&
                    $request->qty[$key] != "" &&
                    $request->price[$key] != "" &&
                    $request->total[$key] != ""
                ) {
                    $saleproduct = SaleProduct::create([
                        'sale_id' => $sale->id,
                        'title'=> $request->title[$key],
                        'qty' => $request->qty[$key],
                        'price' => $request->price[$key],
                        'total' => $request->total[$key],
                    ]);

                    $product = Product::where('title', $request->title[$key])->first();
                    $product->update([
                        'qty'=>$product->qty - $request->qty[$key]
                    ]);
                }
            }
        }
        
        return redirect(route('sale.show',$sale->id))->with('success','Sale updated!');
    }
    
    public function destroy(Sale $sale){
        $sale->delete();
        return redirect()->route('sale.index')->with('success','Sale deleted');
    }

    
    public function printInvoice($id){
        $sale = Sale::whereKey($id)->with('customer','saleProducts')->first();
        return view('admin.sale.invoice',compact('sale'));
    }

    public function filter(Request $request){
        if($request->datepicker){
            $data = explode('-',$request->datepicker);
            $start = Carbon::parse($data[0]);
            $end = Carbon::parse($data[1]);
            
            $sales = Sale::whereBetween('created_at',[$start,$end])->get();
        }else{
            $sales = Sale::whereDay('created_at',Carbon::today())->get();
        }
        
        return view('admin.sale.index',compact('sales'));
    }
    
}
