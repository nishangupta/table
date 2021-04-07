<?php

namespace App\Http\Controllers\Admin;

use App\Models\Expense;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class ExpenseController extends Controller
{
    public function index(){
        $expenses = Expense::with('category')->latest()->get();
        return view('admin.expense.index',compact('expenses'));
    }

    public function create(){
        $categories = Category::all();
        return view('admin.expense.create',compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'title'=>'required|min:3',
            'description'=>'nullable',
            'price'=>'required',
            'category_id'=>'required'
        ]);

        $expense = Expense::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'price'=>$request->price,
            'category_id'=>$request->category_id
        ]);

        return redirect()->route('expense.index')->with('success','expense created!');
    }
    
    public function show(Expense $expense){
        return view('admin.expense.show',compact('expense'));
    }

    public function edit(Expense $expense){
        $categories = Category::all();
        return view('admin.expense.edit',compact('expense','categories'));
    }

    public function update(Request $request,Expense $expense){
        $request->validate([
            'title'=>'required|min:3',
            'description'=>'nullable',
            'price'=>'required',
            'category_id'=>'required'
        ]);

        $expense->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'price'=>$request->price,
            'category_id'=>$request->category_id
        ]);
        
        return redirect(route('expense.index'))->with('success','expense updated!');
    }
    
    public function destroy(Expense $expense){
        $expense->delete();
        return redirect()->route('expense.index')->with('success','expense deleted');
    }

    public function filter(Request $request){
        if($request->datepicker){
            $data = explode('-',$request->datepicker);
            $start = Carbon::parse($data[0]);
            $end = Carbon::parse($data[1]);
            
            $expenses = Expense::whereBetween('created_at',[$start,$end])->get();
        }else{
            $expenses = Expense::whereDay('created_at',Carbon::today())->get();
        }
        
        return view('admin.expense.index',compact('expenses'));
    }
}
