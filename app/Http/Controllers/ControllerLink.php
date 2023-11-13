<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $name = $request->input('name_trans');
        $value = $request->input('value_trans');
        $type = $request->input('select-type'); 

        //inset to data
        
    }

}
