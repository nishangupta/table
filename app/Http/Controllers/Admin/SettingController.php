<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index(){
        $settings = Setting::paginate(25);
        return view('admin.setting.index',compact('settings'));
    }

    public function create(){
        return view('admin.setting.create');
    }

    public function store(Request $request){
        $request->validate([
            'title'=>'required|min:3|unique:settings',
            'value'=>'required'
        ]);

        $setting = Setting::create([
            'title'=>$request->title,
            'value'=>$request->value
        ]);
        
        cache()->forget('settings');
        
        if($setting){
            return redirect(route('setting.index'))->with('success','Setting created!');
        }else{
            return redirect(route('setting.value'))->with('danger','Something went wrong!');
        }
    }

    public function show(Setting $setting){
        return view('admin.setting.show',compact('setting'));
    }

    public function edit(Setting $setting){
        return view('admin.setting.edit',compact('setting'));
    }

    public function update(Request $request,Setting $setting){
        $request->validate([
            'title'=>'required|min:3',
            'value'=>'required',
        ]);

        $setting->update([
            'title'=>$request->title,
            'value'=>$request->value,
        ]);

        cache()->forget('settings');
        
        return redirect(route('setting.index'))->with('success','Setting updated!');
    }
    
    public function destroy(Setting $setting){
        $setting->delete();

        cache()->forget('settings');

        return redirect()->route('setting.index')->with('success','Setting deleted');

    }

    public function upload(Request $request){   
        $request->validate([
            'logo'=>'required|image'
        ]);

        if ($request->hasFile('logo')) {
            $fileName = $request->file('logo')->getClientOriginalName();
            $actualFileName = pathinfo($fileName, PATHINFO_FILENAME);
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            $fileNameToStore = $actualFileName . time() . '.' . $fileExtension;
            $path = $request->file('logo')->storeAs('public/', $fileNameToStore);
      
            $cover = 'storage/' . $fileNameToStore;

          }else{
            $cover = null;
        }

        $setting = Setting::where('title','logo')->first();

        if($setting){
            $logo = $setting->where('title','logo')->first();
            Storage::delete('public/'.basename($logo->value));

            $setting->update([
                'title'=>'logo',
                'value'=>$cover
            ]);
        }else{
            $setting = Setting::create([
                'title'=>'logo',
                'value'=>$cover
            ]); 
        }
        cache()->forget('settings');

        return redirect()->route('setting.index')->with('success','Logo updated');
    }
}
