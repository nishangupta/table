<?php

namespace App\Http\Controllers\Admin;

use App\Models\TableType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TableTypeController extends Controller
{
    public function index(){
        $tableTypes = TableType::all();
        return view('admin.table-type.index',compact('tableTypes'));
    }

    public function create(){
        return view('admin.table-type.create');
    }

    public function store(Request $request){
        $request->validate([
            'title'=>'required|unique:table_types',
        ]);

        $tableType = TableType::create([
            'title'=>$request->title,
        ]);

        return redirect()->route('tableType.index')->with('success','Table Type created!');
    }
    
    // public function show(TableType $tableType){
    //     return view('admin.table-type.show',compact('tableType'));
    // }

    public function edit(TableType $tableType){
        return view('admin.table-type.edit',compact('tableType'));
    }

    public function update(Request $request,TableType $tableType){
        $request->validate([
            'title'=>'required|min:3|unique:table_types,title,'.$tableType->id,
        ]);

        $tableType->update([
            'title'=>$request->title,
        ]);
        
        return redirect(route('tableType.index'))->with('success','Table Type updated!');
    }
    
    public function destroy(TableType $tableType){
        $tableType->delete();
        return redirect()->route('tableType.index')->with('success','Table Type deleted');
    }
}
