<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    public function index(){
        $feedbacks = Reservation::whereNotNull('feedback')->select(['id','fname','lname','feedback','updated_at'])->get();
        return view('admin.feedback.index',compact('feedbacks'));
    }

    public function destroy($feedback){
        $feedback = DB::table('reservations')->where('id',$feedback)->update([
            'feedback'=>null,
        ]);
        return redirect()->route('feedback.index');
    }
}
