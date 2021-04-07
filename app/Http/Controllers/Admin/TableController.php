<?php

namespace App\Http\Controllers\Admin;

use App\Models\Table;
use App\Models\TableType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TableController extends Controller
{
    public function index(){
        $tables = Table::with('tableType')->get();
        return view('admin.table.index',compact('tables'));
    }

    public function create(){
        $tableTypes = TableType::all();
        return view('admin.table.create',compact('tableTypes'));
    }

    public function store(Request $request){
        $request->validate([
            'title'=>'required|min:3',
            'table_type_id'=>'required',
            'chair'=>'required',
            'status'=>'required',
        ]);

        $table = Table::create([
            'title'=>$request->title,
            'table_type_id'=>$request->table_type_id,
            'chair'=>$request->chair,
            'status'=>$request->status,
            'description'=>$request->description,
        ]);

        return redirect()->route('table.index')->with('success','Table created!');
    }
    
    // public function show($table){
    //     $table = Table::whereKey($table)->with('tableType')->first();
    //     return view('admin.table.show',compact('table'));
    // }

    public function edit($table){
        $tableTypes = TableType::all();
        $table = Table::whereKey($table)->with('tableType')->first();
        return view('admin.table.edit',compact('table','tableTypes'));
    }

    public function update(Request $request,Table $table){
        $request->validate([
            'title'=>'required',
            'chair'=>'required',
            'description'=>'',
            'table_type_id'=>'required',
        ]);

        $table->update([
            'title'=>$request->title,
            'table_type_id'=>$request->table_type_id,
            'chair'=>$request->chair,
            'status'=>$request->status,
            'description'=>$request->description
        ]);
        
        return redirect(route('table.index'))->with('success','Table updated!');
    }
    
    public function destroy(Table $table){
        $table->delete();
        return redirect()->route('table.index')->with('success','Table deleted');
    }
}
