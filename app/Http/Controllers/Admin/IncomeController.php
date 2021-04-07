<?php

namespace App\Http\Controllers\Admin;

use App\Models\Billing;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;

class IncomeController extends Controller
{
    public function index(){
        $incomes = Billing::whereNotNull('total')->with(array('reservation' => function($query) {
            $query->select('id','fname','lname','confirmation_number');
        }))->latest('updated_at')->get();
        return view('admin.income.index',compact('incomes'));
    }

    public function filter(Request $request){
        if($request->datepicker){
            $data = explode('-',$request->datepicker);
            $start = Carbon::parse($data[0]);
            $end = Carbon::parse($data[1]);
            
            $incomes = Billing::whereBetween('created_at',[$start,$end])->whereNotNull('total')->with(array('reservation' => function($query) {
                $query->select('id','fname','confirmation_number');
            }))->get();
        }else{
            $incomes = Billing::whereDay('created_at',Carbon::today())->whereNotNull('total')->with(array('reservation' => function($query) {
                $query->select('id','fname','confirmation_number');
            }))->get();
        }
        
        return view('admin.income.index',compact('incomes'));
    }
}
