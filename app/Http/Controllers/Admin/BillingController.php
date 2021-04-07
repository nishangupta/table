<?php

namespace App\Http\Controllers\Admin;

use App\Models\Billing;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class BillingController extends Controller
{
    public function create($reservation){
        $reservation = Reservation::whereKey($reservation)->with('room')->first();
        
        //getting the days 
        $start = Carbon::parse($reservation->checkin.' '.$reservation->checkin_time);
        $end = Carbon::parse($reservation->checkout.' '.$reservation->checkout_time);
        $days = $end->diffInDays($start);

        if($days == 0){
            $days = 1; 
        }
        if($reservation->checkout_time > 11){
            $days = $days +1;
        }

        $orders = $reservation->orders;
        $dueTotal = 0;
        $subTotal = 0;
        $paidTotal = 0;
        foreach($orders as $o){
            $bal = $o->due_amount;
            $dueTotal += $bal;
            $subTotal += $o->total_amount;
            $paidTotal += $o->paid_amount;
        }   

        $roomRate = $reservation->room_rate * $days;

        $billing = $reservation->billing;
        $otherCost = 0;
        if($billing){
            $otherCost = $billing->telephone + $billing->misc + $billing->service_charge;
        }
        $grandTotal  = $roomRate + $dueTotal + $otherCost;
        
        return view('admin.billing.create',compact('reservation','orders','days',
                'billing','dueTotal','grandTotal','roomRate','paidTotal','subTotal'));
    }
    
    public function show(Billing $billing){
        return view('admin.billing.show',compact($billing));
    }

    public function store(Request $request){
        $reservation = Reservation::whereKey($request->reservation)->first();
        $reservation->update([
            'feedback'=>$request->feedback
        ]);

        $billing = $reservation->billing;
        if($billing){
            $billing->update([
                'telephone'=>$request->telephone,
                'service_charge'=>$request->service_charge,
                'misc'=>$request->misc,
                'total'=>$request->total,
            ]);
        }else{
            Billing::create([
                'telephone'=>$request->telephone,
                'service_charge'=>$request->service_charge,
                'misc'=>$request->misc,
                'total'=>$request->total,
                'reservation_id'=>$request->reservation,
            ]);
        }
        return redirect(route('billing.create',$reservation->id));
    }

    //Billing controller
    //set reservation as checkout
    //update room status
    //set billing amount as as total amount
    public function update($reservation){
        $reservation = Reservation::whereKey($reservation)->with('room')->first();
        
        $reservation->update([
            'status'=>'paid',
        ]);

        //update room status
        $reservation->room->update([
            'is_reserved'=>0
        ]);

        $start = Carbon::parse($reservation->checkin.' '.$reservation->checkin_time);
        $end = Carbon::parse($reservation->checkout.' '.$reservation->checkout_time);
        $days = $end->diffInDays($start);

        if($days == 0){
            $days = 1; 
        }
        if($reservation->checkout_time > 11){
            $days = $days + 1;
        }

        $orders = $reservation->orders;
        
        $dueTotal = 0;
        $subTotal = 0;
        $paidTotal = 0;
        foreach($orders as $o){
            $bal = $o->due_amount;
            $dueTotal += $bal;
            $subTotal += $o->total_amount;
            $paidTotal += $o->paid_amount;
        }   
        $roomRate = $reservation->room_rate * $days;

        $billing = $reservation->billing;
        $otherCost = 0;
        if($billing){
            $otherCost = $billing->telephone + $billing->misc + $billing->service_charge;
            $billing->update([
                'total'=>$roomRate + $dueTotal + $otherCost,
            ]);
        }else{
            Billing::create([
                'total'=>$roomRate + $dueTotal + $otherCost,
                'reservation_id'=>$reservation->id,
            ]);
        }

        $grandTotal  = $roomRate + $dueTotal + $otherCost;
        // $qrData = [
        //     'confirmation_number'=>$reservation->confirmation_number,
        // ];
        session()->flash('success','Reservation set as paid');
        return view('admin.billing.create',compact('reservation','orders','days',
            'billing','dueTotal','grandTotal','roomRate','paidTotal','subTotal'));
    }
}
