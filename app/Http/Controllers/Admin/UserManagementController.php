<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function __construct(){
        $this->middleware('role:admin');
    }

    public function index(){
        $users = User::with('roles')->paginate(25);
        return view('admin.usermanagement.index',compact('users'));
    }

    public function create(){
        $roles = Role::all();
        return view('admin.usermanagement.create',compact('roles'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:3',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users'
            ],
            'password'=>'required|min:6',
            'role'=>'required',
        ]);    
        
        DB::transaction(function () use ($request) {
            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'phone'=>$request->phone,
                'address'=>$request->address,
            ]);

            $user->assignRole($request->role);

        }, 5);

        return redirect(route('usermanagement.index'))->with('success','User/Admin Created');
    }

    public function edit($id){
        $user = User::whereKey($id)->first(); 
        $userRole = $user->roles->first();
        $roles = Role::all();
        return view('admin.usermanagement.edit',compact('user','roles','userRole'));
    }

    public function update(Request $request,$id){
        $user = User::find($id);
        
        $request->validate([
            'name' => 'required|min:3',
            'email' => ['required','string','email','max:255','unique:users,email,'.$id],
            'role'=>'required',
        ]);    
            
        if($request->password != ''){
            $request->validate([
                'password'=>'min:6'
            ]);

            $password =Hash::make($request->password);
        }else{
            $password = $user->password;
        }

        DB::transaction(function () use ($request,$user,$password) {
            $user->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$password,
                'phone'=>$request->phone,
                'address'=>$request->address,
            ]);
            
            $user->roles()->detach();
            $user->assignRole($request->role);
        }, 5);

        return redirect(route('usermanagement.index'))->with('success','User/Admin updated');
    }


    public function destroy($id){
        $user = User::whereKey($id)->first(); 
        $user->delete();
        return redirect()->route('usermanagement.index')->with('success','User/Admin Deleted');
    }
}
