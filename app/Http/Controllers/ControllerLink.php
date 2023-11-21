<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;

//install composer require nesbot/carbon
//import
use Carbon\Carbon;

class ControllerLink extends Controller

/**********************************************************************************************************/
/**********************************************************************************************************/
/**********************************************************************************************************/
/**********************************************************************************************************/

{
    //
    public function addTranscation()
    {
        $user = auth()->user();
        //return view('dashboard', compact('wallet_bank'));
        $name = DB::table('users')->select('name', 'id')->where('id', $user->id)->get();
        return view('add_transcation', compact('name'));
    }

    
/**********************************************************************************************************/
/**********************************************************************************************************/
/**********************************************************************************************************/
/**********************************************************************************************************/

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

/**********************************************************************************************************/
/**********************************************************************************************************/
/**********************************************************************************************************/
/**********************************************************************************************************/

    //showBank
    public function editBank()
    {
        $user = auth()->user();
        $userdata = DB::table('users')->select('name', 'id')->where('id', $user->id)->get();

        $show_id_bank = DB::table('bank')->select('id_bank')->where('user_name', $user->id)->get();
        
        //Count bank and Sum Money
        $all_bank_count = DB::table('bank')
        ->where('user_name', $userdata[0]->name)
        ->count('name_bank');

        $all_bank_sum = DB::table('bank')
        ->where('user_name', $userdata[0]->name)
        ->sum('wallet_bank');

        #Show bank
        $show_bank_data = DB::table('bank')
        ->select('name_bank', 'wallet_bank', 'id_bank')
        ->where('user_name', $userdata[0]->name)
        ->get();

        //array
        $data_fn_edit_bank = [
            'bank_count' => $all_bank_count,
            'bank_sum' => $all_bank_sum,
            'bank_data' => $show_bank_data,
        ];

        //session to function
        session(['all_data' => $data_fn_edit_bank]);

        return view('edit_bank',compact('all_bank_count', 'all_bank_sum', 'show_bank_data','show_id_bank'));
    }

/**********************************************************************************************************/
/**********************************************************************************************************/
/**********************************************************************************************************/
/**********************************************************************************************************/

    //Add Bank
    public function addBank(){
        //call function session
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

/**********************************************************************************************************/
/**********************************************************************************************************/
/**********************************************************************************************************/
/**********************************************************************************************************/

    //Add Bank From
    public function addAcBank(Request $request){
        $user = auth()->user();
        $userdata = DB::table('users')->select('name', 'id')->where('id', $user->id)->get();
        $name_bank = $request->input('name_bank');
        $wallet_bank = $request->input('wallet_bank');

        DB::table('bank')->insert([
            'name_bank'=>$name_bank,
            'user_name'=>$userdata[0]->name,
            'wallet_bank'=>$wallet_bank,
        ]);

        return redirect()->route('edit_bank');
    }

/**********************************************************************************************************/
/**********************************************************************************************************/
/**********************************************************************************************************/
/**********************************************************************************************************/

    //editManageBank
    public function editManageBank(Request $request){
        $user = auth()->user();
        $userdata = DB::table('users')->select('name', 'id')->where('id', $user->id)->get();
        $id_bank = $request->input('id_bank');

        $all_bank_sum = DB::table('bank')
        ->where('id_bank', $id_bank)
        ->sum('wallet_bank');

        $select_bank_name = DB::table('bank')
        ->select('name_bank')
        ->where('id_bank', $id_bank)
        ->get();

        return view('edit_manage_bank', compact('id_bank','all_bank_sum', 'select_bank_name'));
    }
/**********************************************************************************************************/
/**********************************************************************************************************/
/**********************************************************************************************************/
/**********************************************************************************************************/
    //Delete Bank
    public function deleteBank(Request $request){
        $user = auth()->user();
        $userdata = DB::table('users')->select('name', 'id')->where('id', $user->id)->get();
        $id_bank = $request->input('id_bank');

        $show_data_bank = DB::table('bank')->select('name_bank', 'wallet_bank')->where('id_bank', $id_bank)->get();
        // ทำสิ่งที่ต้องการด้วย $id_bank ที่ได้รับมา
        return view('delete_bank', compact('id_bank', 'show_data_bank'));
    }

    //Submit Delete Bank
    public function submitDeleteBank(Request $request){
        $user = auth()->user();
        $id_bank = $request->input('id_bank');

        DB::table('bank')
        ->where('id_bank', $id_bank)
        ->delete();
        return redirect()->route('dashboard');
    }
/**********************************************************************************************************/
/**********************************************************************************************************/
/**********************************************************************************************************/
/**********************************************************************************************************/

    //No Income
    public function editNoIncome(){
        $user = auth()->user();
        $userdata = DB::table('users')->select('name', 'id')->where('id', $user->id)->get();
        
        $noincome_sum = DB::table('no_income')
        ->where('user_name', $userdata[0]->name)
        ->sum('wallet_noincome');

        $noincome_count = DB::table('no_income')
        ->where('user_name', $userdata[0]->name)
        ->count('id_noincome');

        $all_noincome = DB::table('no_income')
        ->select('id_noincome', 'name_noincome', 'wallet_noincome')
        ->where('user_name', $userdata[0]->name)
        ->get();

        return view('edit_no_income', compact('noincome_sum', 'all_noincome', 'noincome_count'));
        
    }

    //Add-No-Income
    public function addNoIncome(){
        $user = auth()->user();

        return view('add_no_income');
    }

    //Add Account No-Income
    public function addAcNoIncome(Request $request){
        $user = auth()->user();
        $userdata = DB::table('users')
        ->select('name', 'id')
        ->where('id', $user->id)
        ->get();
        
        $name_no_income = $request->input('name_no_income');
        $wallet_no_income = $request->input('wallet_no_income');

        DB::table('no_income')
            ->insert([
                'name_noincome'=>$name_no_income,
                'user_name'=>$userdata[0]->name,
                'wallet_noincome'=>$wallet_no_income,
            ]);

        return redirect()->route('edit_no_income');
    }

    //Manage Accoute No-Income
    public function editMnNoIncome(Request $request){
        $user = auth()->user();
        $id_income = $request->input('id');

        $data_no_income = DB::table('no_income')
        ->select('name_noincome', 'wallet_noincome')
        ->where('id_noincome',$id_income)
        ->get();
        
        return view('edit_mn_no_income', compact('id_income', 'data_no_income'));
    }

    //=============================================================================================
    //=============================================================================================
    //=============================================================================================

    //No Expense
    public function editNoExpense(){
        $user = auth()->user();
        $userdata = DB::table('users')->select('name', 'id')->where('id', $user->id)->get();

        $noexpense_sum = DB::table('no_expense')
        ->where('user_name', $userdata[0]->name)
        ->sum('wallet_noexpense');

        $noexpense_count = DB::table('no_expense')
        ->where('user_name', $userdata[0]->name)
        ->count('id_noexpense');

        $all_noexpense = DB::table('no_expense')
        ->select('id_noexpense', 'name_noexpense', 'wallet_noexpense')
        ->where('user_name', $userdata[0]->name)
        ->get();

        return view('edit_no_expense', compact('noexpense_sum', 'noexpense_count', 'all_noexpense'));
    }

    //Add-No-Expense
    public function addNoExpense(){
        $user = auth()->user();

        return view('add_no_expense');
    }

    //Add Account No-Income
    public function addAcNoExpense(Request $request){
        $user = auth()->user();
        $userdata = DB::table('users')
        ->select('name', 'id')
        ->where('id', $user->id)
        ->get();
        
        $name_no_expense = $request->input('name_no_expense');
        $wallet_no_expense = $request->input('wallet_no_expense');

        DB::table('no_expense')
            ->insert([
                'name_noexpense'=>$name_no_expense,
                'user_name'=>$userdata[0]->name,
                'wallet_noexpense'=>$wallet_no_expense,
            ]);

        return redirect()->route('edit_no_expense');
    }

    //editMnNoExpense
    //Manage Accoute No-Income
    public function editMnNoExpense(Request $request){
        $user = auth()->user();
        $id_expense = $request->input('id');

        $data_no_expense = DB::table('no_expense')
        ->select('name_noexpense', 'wallet_noexpense')
        ->where('id_noexpense', $id_expense)
        ->get();
        
        return view('edit_mn_no_expense', compact('id_expense','data_no_expense'));
    }
    
    
/**********************************************************************************************************/
/**********************************************************************************************************/
/**********************************************************************************************************/
/**********************************************************************************************************/

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

/**********************************************************************************************************/
/**********************************************************************************************************/
/**********************************************************************************************************/
/**********************************************************************************************************/
 
    //Update Bank From
    public function updateBank(Request $request)
    {
        $user = auth()->user();
        $userdata = DB::table('users')->select('name', 'id')->where('id', $user->id)->get();

        $id_bank = $request->input('id_bank');
        $name_update = $request->input('name_update');
        $money_update = $request->input('money_update');

        $update_bank = DB::table('bank')
            ->where('id_bank', $id_bank)
            ->update(['name_bank' => $name_update,'wallet_bank' => $money_update]);
        
        return redirect()->route('edit_bank');

    }
    
/**********************************************************************************************************/
/**********************************************************************************************************/
/**********************************************************************************************************/
/**********************************************************************************************************/

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

/**********************************************************************************************************/
/**********************************************************************************************************/
/**********************************************************************************************************/
/**********************************************************************************************************/

