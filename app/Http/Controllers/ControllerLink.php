<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Transaction;

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
    
    //edit_fiat
    public function editFiat()
    {
        $user = auth()->user();
        $userdata = DB::table('users')->select('name', 'id')->where('id', $user->id)->get();

        $name = DB::table('transcations')->select('id_transaction', 'fiat_wallet')
        ->where('user_name', $userdata[0]->name)
        ->whereNotNull('fiat_wallet')
        ->orderBy('id_transaction', 'desc')
        ->limit(1)
        ->get();

        return view('edit_fiat', compact('name'));

    }
    //Update Fiat From
    public function updateFiat(Request $request)
    {
        $user = auth()->user();
        $userdata = DB::table('users')->select('name', 'id')->where('id', $user->id)->get();
        //fiat update input from form edit_fiat
        $fiat_input = $request->input('fiat_update');

        $update_fiat = DB::table('transcations')
            ->where('user_name', $userdata[0]->name)
            ->latest('id_transaction')
            ->limit(1)
            ->update(['fiat_wallet' => $fiat_input]);
    }

    //insert into Transaction
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
