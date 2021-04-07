<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use App\Models\Sale;
use App\Models\Income;
use App\Models\Billing;
use App\Models\Expense;
use App\Models\Purchase;
use App\Models\StockAlert;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(Request $request){
        $roomCount = Room::count();
        $availableRoomCount= Room::where('is_reserved',0)->count();
        $reservationCount = Reservation::where('status','pending')->count();
        $totalIncomes  = Billing::sum('total');

        return view('admin.dashboard',compact('roomCount','availableRoomCount','reservationCount','totalIncomes',
        ));
    }


    protected function old(){
        $day = date('d');
        $month = date('m');
        $year = date('Y');
        
        // if($request->q=='yearly'){
        //     $totalSales = Sale::whereYear('created_at',$year)->sum('total_amount');
        //     $totalExpense = Expense::whereYear('created_at',$year)->sum('price');
        //     $revenue = Sale::whereYear('created_at',$year)->sum('paid_amount');
        //     $income = Income::whereYear('created_at',$year)->sum('price');   
        //     $purchase = Purchase::whereYear('created_at',$year)->sum('cost_price');   

        // }else if($request->q == 'monthly'){   
        //     $totalSales = Sale::whereMonth('created_at',$month)->whereYear('created_at',$year)->sum('total_amount');
        //     $totalExpense = Expense::whereMonth('created_at',$month)->whereYear('created_at',$year)->sum('price');
        //     $revenue = Sale::whereMonth('created_at',$month)->whereYear('created_at',$year)->sum('paid_amount');
        //     $income = Income::whereMonth('created_at',$month)->whereYear('created_at',$year)->sum('price');
        //     $purchase = Purchase::whereMonth('created_at',$month)->whereYear('created_at',$year)->sum('cost_price');

        // }else{
        //     $totalSales = Sale::whereDay('created_at',$day)->whereYear('created_at',$year)->sum('total_amount');
        //     $totalExpense = Expense::whereDay('created_at',$day)->whereYear('created_at',$year)->sum('price');
        //     $revenue = Sale::whereDay('created_at',$day)->whereYear('created_at',$year)->sum('paid_amount');
        //     $income = Income::whereDay('created_at',$day)->whereYear('created_at',$year)->sum('price');
        //     $purchase = Purchase::whereDay('created_at',$day)->whereYear('created_at',$year)->sum('cost_price');
            
        // }
        
        // $totalIncome = $revenue + $income;
        // $totalProfit = $totalIncome - $totalExpense - $purchase;

        // $lowStocks = StockAlert::with('product')->get();
        

    }

}
