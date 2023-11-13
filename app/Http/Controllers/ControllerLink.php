<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//install composer require nesbot/carbon
//import
use Carbon\Carbon;



class ControllerLink extends Controller
{
    //
    public function addTranscation()
    {
        $user = auth()->user();
        //return view('dashboard', compact('wallet_bank'));
        $name = DB::table('users')->select('name', 'id')->where('id', $user->id)->get(); // ใช้ first() เพื่อให้ได้ผลลัพธ์เป็น object แทน array
        return view('add_transcation', compact('name'));
    }

    public function saveTransaction(Request $request)
    {
        $user = auth()->user();
        $userdata = DB::table('users')->select('name', 'id')->where('id', $user->id)->get();

        $name = $request->input('name_trans');
        $value = $request->input('value_trans');
        $type = $request->input('select_type');

        //Set Time Zone Asia
        Carbon::setLocale('th_TH');
        Carbon::setToStringFormat('l jS F Y h:i:s A');
        date_default_timezone_set('Asia/Bangkok');
        $time_at = Carbon::now('Asia/Bangkok');

        DB::table('transcations')->insert([
            'name_transaction'=>$name,
            'value'=>$value,
            'type'=>$type,
            'created_at'=>$time_at,
            'user_name'=>$userdata[0]->name,

        ]);

        return redirect()->back();
    }



}
