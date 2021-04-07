<?php

namespace App\Http\Controllers\Admin;

use App\Models\Table;
use App\Models\Reservation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ReservationTable;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class ReservationController extends Controller
{
    public function index(){
        $reservations = Reservation::latest()->get();
        // dd($reservations);
        return view('admin.reservation.index',compact('reservations'));
    }

    public function create(){
        $tables = Table::where('status','open')->get();
        // dd($tables);
        return view('admin.reservation.create',compact('tables'));
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'person'=>'required|integer',
            'phone'=>'sometimes',
            'reservation_date'=>'required',
            'reservation_time'=>'required',
            'table.*'=>'required',
        ]);

        //check if the customers can accomodate in the tables
        $totalChairs = Table::whereIn('id',$request->table)->sum('chair');
        if($totalChairs < $request->person){
            return redirect()->route('reservation.create')->withInput($request->all())->withErrors(['Chairs insufficent for customers . Add more tables']);
        }

        //generate a random unique string
        $conf_no = Str::upper(Str::random(10));

        $reservation = Reservation::create([
            'name'=>$request->name,
            'person'=>$request->person,
            'phone'=>$request->phone,
            'reservation_date'=>$request->reservation_date,
            'reservation_time'=>$request->reservation_time,
            'confirmation_number'=>$conf_no,
        ]);

        foreach($request->table as $table){
            ReservationTable::create([
                'reservation_id'=>$reservation->id,
                'table_id'=>$table
            ]);

            DB::table('tables')->where('id',$table)->update([
                'status'=>'reserved'
            ]);
        }
        
        return redirect()->route('reservation.show',$reservation->id)->with('success','Reservation created!');
    }
    
    public function show($reservation){
        $reservation = Reservation::whereKey($reservation)->with('tables')->first();
        $orders = $reservation->orders()->withCount('orderProducts')->latest()->get();
        return view('admin.reservation.show',compact('reservation','orders'));
    }



    public function edit(Reservation $reservation){
        $tables = Table::whereStatus('open')->get();
        $selectedTables = $reservation->tables;
        
        # set the selected tables merged with all the tables 
        foreach($selectedTables as $t){
            $t->isSelected = true;
        }

        $tables = $tables->merge($selectedTables);
        return view('admin.reservation.edit',compact('reservation','tables'));
    }





    public function update(Request $request,Reservation $reservation){
        $request->validate([
            'name'=>'required',
            'person'=>'required|integer',
            'phone'=>'sometimes',
            'reservation_date'=>'required',
            'reservation_time'=>'required',
            'table.*'=>'required',
        ]);

        $reservation->update([
            'name'=>$request->name,
            'person'=>$request->person,
            'phone'=>$request->phone,
            'reservation_date'=>$request->reservation_date,
            'reservation_time'=>$request->reservation_time,
        ]);
        
        //get the table ids and delete
        $ids = $reservation->reservationTables()->pluck('table_id');    
        ReservationTable::where('reservation_id',$reservation->id)->delete();    
        DB::table('tables')->whereIn('id',$ids)->update([
            'status'=>'open',
        ]);

        foreach($request->table as $table){
            $reservation->reservationTables()->updateOrCreate([
                'reservation_id'=>$reservation->id,
                'table_id'=>$table
            ]);

            DB::table('tables')->where('id',$table)->update([
                'status'=>'reserved'
            ]);
        }

        return redirect()->route('reservation.show',$reservation->id)->with('success','Reservation updated!');
    }
    
    public function destroy(Reservation $reservation){
        DB::table('rooms')->where('id',$reservation->room_id)->update([
            'is_reserved'=>0 //is_reserved
        ]);
        $reservation->delete();
        return redirect()->route('reservation.index')->with('success','reservation deleted');
    }

    public function filter(Request $request){
        if($request->datepicker){
            $data = explode('-',$request->datepicker);
            $start = Carbon::parse($data[0]);
            $end = Carbon::parse($data[1]);
            
            $reservations = Reservation::whereBetween('created_at',[$start,$end])->get();
        }else{
            $reservations = Reservation::whereDay('created_at',Carbon::today())->get();
        }
        
        return view('admin.reservation.index',compact('reservations'));
    }
}
