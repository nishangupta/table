<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Models\Quotation;
use App\Mail\QuotationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\QuotationProduct;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class QuotationController extends Controller
{
    public function index(){
        $quotations = Quotation::with('customer')->latest()->get();
        return view('admin.quotation.index',compact('quotations'));
    }

    public function create(){
        $customers= Customer::all();
        return view('admin.quotation.create',compact('customers'));
    }

    public function store(Request $request){
        $request->validate([
            'qty.*'=>'required|gt:0',
            'customer_id'=>'required',
            'details'=>'nullable',
            'paid_amount'=>'nullable',
            'discount_amount'=>'max:191',
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
        ];

        $quotation = Quotation::firstOrCreate($data);

        if (!empty($request->title)) {
            foreach ($request->title as $key => $item) {
                if ($item != "" && 
                    $request->title[$key] != "" &&
                    $request->qty[$key] != "" &&
                    $request->price[$key] != "" &&
                    $request->total[$key] != ""
                ) {
                    $quotationProduct = QuotationProduct::create([
                        'quotation_id' => $quotation->id,
                        'title'=> $request->title[$key],
                        'qty' => $request->qty[$key],
                        'price' => $request->price[$key],
                        'total' => $request->total[$key],
                    ]);
                }
            }
        }

        return redirect()->route('quotation.show',$quotation->id)->with('success','Quotation created!');
    }
    
    public function show($quotation){
        $quotation = Quotation::whereKey($quotation)->with('customer','quotationProducts')->first();
        return view('admin.quotation.show',compact('quotation'));
    }

    public function printInvoice($id){
        $quotation = Quotation::whereKey($id)->with('customer','quotationProducts')->first();
        return view('admin.quotation.invoice',compact('quotation'));
    }

    public function mail($id){
        $quotation = Quotation::whereKey($id)->with('customer','quotationProducts')->first();

        $renderedData = view('admin.quotation.invoice',compact('quotation'))->render();

        Mail::to($quotation->customer)->send(new QuotationMail($renderedData));
        return redirect()->route('quotation.show',$id)->with('success','Mail successfully sent');
    }

    public function edit($quotation){
        $quotation = Quotation::whereKey($quotation)->with('customer','quotationProducts')->first();         
        $customers = Customer::all();
        return view('admin.quotation.edit',compact('quotation','customers'));
    }

    public function update(Request $request,$quotation){
        $request->validate([
            'qty.*'=>'required|gt:0',
            'details'=>'nullable',
            'customer_id'=>'required',
            'paid_amount'=>'nullable',
            'discount_amount'=>'max:191',
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
        ];

        $quotation = Quotation::whereKey($quotation)->with('quotationProducts')->first();   

        foreach($quotation->quotationProducts as $p){
            $p->delete(); //deleting old relationship
        }

        $quotation->update($data);

        if (!empty($request->title)) {
            foreach ($request->title as $key => $item) {
                if ($item != "" && 
                    $request->title[$key] != "" &&
                    $request->qty[$key] != "" &&
                    $request->price[$key] != "" &&
                    $request->total[$key] != ""
                ) {
                    $quotationProduct = QuotationProduct::create([
                        'quotation_id' => $quotation->id,
                        'title'=> $request->title[$key],
                        'qty' => $request->qty[$key],
                        'price' => $request->price[$key],
                        'total' => $request->total[$key],
                    ]);

                }
            }
        }
        
        return redirect(route('quotation.show',$quotation->id))->with('success','Quotation updated!');
    }
    
    public function destroy(Quotation $quotation){
        $quotation->delete();
        return redirect()->route('quotation.index')->with('success','Quotation deleted');
    }

    public function filter(Request $request){
        if($request->datepicker){
            $data = explode('-',$request->datepicker);
            $start = Carbon::parse($data[0]);
            $end = Carbon::parse($data[1]);
            
            $quotations = Quotation::whereBetween('created_at',[$start,$end])->get();
        }else{
            $quotations = Quotation::whereDay('created_at',Carbon::today())->get();
        }
        
        return view('admin.quotation.filter',compact('quotations'));
    }
}
