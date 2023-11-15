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
    //showBank
    public function editBank()
    {
        $user = auth()->user();
        $userdata = DB::table('users')->select('name', 'id')->where('id', $user->id)->get();
        
        //Count bank and Sum Money
        $all_bank_count = DB::table('bank')
        ->where('user_name', $userdata[0]->name)
        ->count('name_bank');

        $all_bank_sum = DB::table('bank')
        ->where('user_name', $userdata[0]->name)
        ->sum('wallet_bank');

        #Show bank
        $show_bank_data = DB::table('bank')
        ->select('name_bank', 'wallet_bank')
        ->where('user_name', $userdata[0]->name)
        ->get();

        $data_fn_edit_bank = [
            'bank_count' => $all_bank_count,
            'bank_sum' => $all_bank_sum,
            'bank_data' => $show_bank_data,
        ];

        //session
        session(['all_data' => $data_fn_edit_bank]);

        return view('edit_bank', compact('all_bank_count', 'all_bank_sum', 'show_bank_data'));
    }

    public function addBank(){
        $data_fn_edit_bank = session('all_data');

        if ($data_fn_edit_bank) {
           $all_bank_count = $data_fn_edit_bank['bank_count'];
           $all_bank_sum = $data_fn_edit_bank['bank_sum'];
           $show_bank_data = $data_fn_edit_bank['bank_data'];

           return view('add_bank', compact('all_bank_count', 'all_bank_sum', 'show_bank_data'));
           
        }else{
            return redirect()->route('dashboard');
        }

        //return view('add_bank');
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

        return redirect()->route('edit_fiat');
    }

    //insert into Transaction
    public function saveTransaction(Request $request)
    {
        $user = auth()->user();
        $userdata = DB::table('users')->select('name', 'id')->where('id', $user->id)->get();

        $name_trans = $request->input('name_trans');
        $value_trans = $request->input('value_trans');
        $type = $request->input('select_type');

        //Set Time Zone Asia
        Carbon::setLocale('th_TH');
        Carbon::setToStringFormat('l jS F Y h:i:s A');
        date_default_timezone_set('Asia/Bangkok');
        $time_at = Carbon::now('Asia/Bangkok');

        $name = DB::table('transcations')->select('id_transaction', 'fiat_wallet')
        ->where('user_name', $userdata[0]->name)
        ->whereNotNull('fiat_wallet')
        ->orderBy('id_transaction', 'desc')
        ->limit(1)
        ->get();

        DB::table('transcations')->insert([
            'name_transaction'=>$name_trans,
            'value'=>$value_trans,
            'type'=>$type,
            'created_at'=>$time_at,
            'user_name'=>$userdata[0]->name,
            'fiat_wallet'=>$name[0]->fiat_wallet,
        ]);

        return redirect()->route('dashboard');
    }

}
