<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\Reservation;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function create(Request $request,Reservation $reservation){
        return view('admin.order.create')->with([
            'reservation'=>$request->reservation,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'qty.*'=>'required|gt:0',
            'customer_name'=>'required',
            'discount_amount'=>'max:191',
            'payment_type'=>'required',
            // 'chq_no'=>'required_if:payment_type,bank',
            // 'chq_date'=>'required_if:payment_type,bank',
        ]);

        if($request->paid_amount>0){
            $status = 1;
        }else{
            $status = 0;
        }

        $data = [
            'customer_name'=>$request->customer_name,
            'reservation_id'=>$request->reservation_id,
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
            // 'chq_no'=>$request->chq_no,
            // 'chq_date'=>$request->chq_date,
        ];

        $order = Order::firstOrCreate($data);

        if (!empty($request->title)) {
            foreach ($request->title as $key => $item) {
                if ($item != "" && 
                    $request->title[$key] != "" &&
                    $request->qty[$key] != "" &&
                    $request->price[$key] != "" &&
                    $request->total[$key] != ""
                ) {
                    $orderProduct = OrderProduct::create([
                        'order_id' => $order->id,
                        'title'=> $request->title[$key],
                        'qty' => $request->qty[$key],
                        'price' => $request->price[$key],
                        'total' => $request->total[$key],
                    ]);

                }
            }
        }

        return redirect()->route('order.show',$order->id)->with('success','Order created!');
    }

    public function edit($order){
        $order = Order::whereKey($order)->with('orderProducts')->first();
        return view('admin.order.edit')->with([
            'order'=>$order
        ]);
    }

    public function show($order){
        $order = Order::whereKey($order)->with('orderProducts','reservation')->first();
        return view('admin.order.show')->with([
            'order'=>$order
        ]);
    }

    public function update(Request $request,$order){
        $request->validate([
            'qty.*'=>'required|gt:0',
            'customer_name'=>'required',
            'discount_amount'=>'max:191',
            'payment_type'=>'required',
            // 'chq_no'=>'required_if:payment_type,bank',
            // 'chq_date'=>'required_if:payment_type,bank',
        ]);
       
        if($request->paid_amount>0){
            $status = 1;
        }else{
            $status = 0;
        }

        $data = [
            'customer_name'=>$request->customer_name,
            'reservation_id'=>$request->reservation_id,
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
            // 'chq_no'=>$request->chq_no,
            // 'chq_date'=>$request->chq_date,
        ];

        $order = Order::whereKey($order)->with('orderProducts')->first();   

        foreach($order->orderProducts as $p){
            $p->delete(); //deleting old relationship
        }

        $order->update($data);

        if (!empty($request->title)) {
            foreach ($request->title as $key => $item) {
                if ($item != "" && 
                    $request->title[$key] != "" &&
                    $request->qty[$key] != "" &&
                    $request->price[$key] != "" &&
                    $request->total[$key] != ""
                ) {
                    $orderProduct = OrderProduct::create([
                        'order_id' => $order->id,
                        'title'=> $request->title[$key],
                        'qty' => $request->qty[$key],
                        'price' => $request->price[$key],
                        'total' => $request->total[$key],
                    ]);

                }
            }
        }
        
        return redirect(route('order.show',$order->id))->with('success','Order updated!');
    }

    public function destroy(Order $order){
        $id = $order->reservation_id;
        $order->delete();
        return redirect()->route('reservation.show',$id)->with('success','Order deleted');
    }
}
