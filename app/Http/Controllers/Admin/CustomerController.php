<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::latest()->get();
        return view('admin.customer.index',compact('customers'));
    }

    public function create(){
        return view('admin.customer.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:3',
        ]);    
        
        DB::transaction(function () use ($request) {
            $customer = Customer::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'address'=>$request->address,
            ]);

        }, 5);

        return redirect(route('customer.index'))->with('success','Customer Created');
    }

    public function edit($id){
        $customer = Customer::whereKey($id)->first(); 
        return view('admin.customer.edit',compact('customer'));
    }

    public function show($customer){
        $customer = Customer::findOrFail($customer);
        $sales = Sale::where('customer_id',$customer->id)->withCount('saleProducts')->paginate(25);
        $pendingBal = $sales->sum('due_amount');
        return view('admin.customer.show',compact('customer','sales','pendingBal'));
    }

    public function update(Request $request,Customer $customer){
        $request->validate([
            'name' => 'required|min:3',
        ]);    
        
        DB::transaction(function () use ($request,$customer) {
            $customer->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'address'=>$request->address,
            ]);
        }, 5);

        return redirect(route('customer.index'))->with('success','Customer updated');
    }


    public function destroy(Customer $customer){
        $customer->delete();
        return redirect()->route('customer.index')->with('success','Customer Deleted');
    }

    public function filter(Request $request){
        if($request->datepicker){
            $data = explode('-',$request->datepicker);
            $start = Carbon::parse($data[0]);
            $end = Carbon::parse($data[1]);
            
            $customers = Customer::whereBetween('created_at',[$start,$end])->get();
        }else{
            $customers = Customer::whereDay('created_at',Carbon::today())->get();
        }
        
        return view('admin.customer.index',compact('customers'));
    }
}
