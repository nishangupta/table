<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Models\Income;
use App\Models\Expense;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SummaryController extends Controller
{
    public function index(){
        $year = date('Y');
        $lastYearSales = $this->getSales(false); 
        $thisYearSales = $this->getSales();

        $totalSales = Sale::whereYear('updated_at',$year)->sum('total_amount');
        $totalExpense = Expense::whereYear('updated_at',$year)->sum('price');
        $revenue = Sale::whereYear('updated_at',$year)->sum('paid_amount');
        $income = Income::whereYear('updated_at',$year)->sum('price');   
        $purchase = Purchase::whereYear('updated_at',$year)->sum('cost_price');   
        
        return view('admin.summary.index',compact('lastYearSales','thisYearSales',
                    'totalSales','totalExpense','revenue','income','purchase'));
    }

    // Returns an array of record
    private function getSales($thisYear = true){
        if($thisYear){
            $year = date('Y');
        }else{
            $year = date('Y')-1;
        }
        $sales = Sale::select(
            DB::raw('sum(total_amount) as sums'), 
            DB::raw("DATE_FORMAT(created_at,'%m') as monthKey"))
            ->whereYear('created_at', $year)
            ->groupBy('monthKey')
            ->orderBy('created_at', 'ASC')
            ->get();

        $yearSales = [0,0,0,0,0,0,0,0,0,0,0,0];

        foreach($sales as $sale){
            $yearSales[$sale->monthKey-1] = $sale->sums;
        }

        return $yearSales;
    }
}
