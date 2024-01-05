<?php
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ControllerLink;
use App\Http\Controllers\updownController;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        $userdata = DB::table('users')->select('name', 'id', 'fiat_wallet')->where('id', $user->id)->get();

        $name = DB::table('transcations')->select('id_transaction', 'fiat_wallet')
        ->where('user_name', $userdata[0]->name)
        ->whereNotNull('fiat_wallet')
        ->orderBy('id_transaction', 'desc')
        ->limit(1)
        ->get();
        
        //Show Bank Money To Dashboard
        $bankMoney = DB::table('bank')
        ->select('wallet_bank')
        ->where('user_name', $userdata[0]->name)
        ->get();

        //Show Bank To dashboard
        $all_bank_sum = DB::table('bank')
        ->where('user_name', $userdata[0]->name)
        ->sum('wallet_bank');

        //Show No income to Dashboard
        $noincome_sum = DB::table('no_income')
        ->where('user_name', $userdata[0]->name)
        ->sum('wallet_noincome');

        $noincome_get_sum = DB::table('no_income')
        ->where('user_name', $userdata[0]->name)
        ->sum('wallet_get');

        //Show No expense to Dashboard
        $noexpense_sum = DB::table('no_expense')
        ->where('user_name', $userdata[0]->name)
        ->sum('wallet_noexpense');

        $noexpense_get_sum = DB::table('no_expense')
        ->where('user_name', $userdata[0]->name)
        ->sum('wallet_back');

        //Show Total fiat - total noexpense
        $fiatwallet = $userdata[0]->fiat_wallet;

        //select wallet_get  - wallet_noincome = 0

        $wallet_get_noincome = DB::table('no_income')
        ->select('wallet_get','wallet_noincome')
        ->where('user_name', $userdata[0]->name)
        ->get();

        //Show Total fiat + total Bank + noincome
        $total_money_income = ($fiatwallet + $all_bank_sum + ($noincome_sum - $noincome_get_sum));
        
        $total_sum_expense = DB::table('transcations')
        ->where('user_name', $userdata[0]->name)
        ->where('type', 'expense')
        ->sum('value');

        $date_now = Carbon::now()->locale('th')->isoFormat('LL');

        $date_now_today = now();

        $total_all_transc = DB::table('transcations')
        ->where('user_name', $userdata[0]->name)
        ->whereDate('created_at', $date_now_today->toDateString())
        ->count('id_transaction');

        //เรียงค่าเงิน น้อยไปมาก
        $asc_value_income = DB::table('transcations')
            ->select('value')
            ->where('user_name', $userdata[0]->name)
            ->where('type', 'income')
            ->whereDate('created_at', $date_now_today->toDateString()) // กรองเฉพาะวันที่ตรงกับวันปัจจุบัน
            ->orderBy('value', 'ASC')
            ->limit(1)
            ->get();

        $asc_value_expense = DB::table('transcations')
            ->select('value')
            ->where('user_name', $userdata[0]->name)
            ->where('type', 'expense')
            ->whereDate('created_at', $date_now_today->toDateString()) // กรองเฉพาะวันที่ตรงกับวันปัจจุบัน
            ->orderBy('value', 'ASC')
            ->limit(1)
            ->get();

        $desc_value_income = DB::table('transcations')
            ->select('value')
            ->where('user_name', $userdata[0]->name)
            ->where('type', 'income')
            ->whereDate('created_at', $date_now_today->toDateString()) // กรองเฉพาะวันที่ตรงกับวันปัจจุบัน
            ->orderBy('value', 'DESC')
            ->limit(1)
            ->get();

        $desc_value_expense = DB::table('transcations')
            ->select('value')
            ->where('user_name', $userdata[0]->name)
            ->where('type', 'expense')
            ->whereDate('created_at', $date_now_today->toDateString()) // กรองเฉพาะวันที่ตรงกับวันปัจจุบัน
            ->orderBy('value', 'DESC')
            ->limit(1)
            ->get();

        $average_value_income = DB::table('transcations')
            ->where('user_name', $userdata[0]->name)
            ->where('type', 'income')
            ->whereDate('created_at', $date_now_today->toDateString()) // กรองเฉพาะวันที่ตรงกับวันปัจจุบัน
            ->avg('value');

        $average_value_expense = DB::table('transcations')
            ->where('user_name', $userdata[0]->name)
            ->where('type', 'expense')
            ->whereDate('created_at', $date_now_today->toDateString()) // กรองเฉพาะวันที่ตรงกับวันปัจจุบัน
            ->avg('value');

        //all transcation
        $all_trans = DB::table('transcations')
            ->select('*')
            ->where('user_name', $userdata[0]->name)
            ->orderBy('created_at', 'DESC')
            ->get();


        $total_fiat_expense = ($fiatwallet + $all_bank_sum + ($noexpense_get_sum - $noexpense_sum));

        return view('dashboard', compact(
            'name', 'bankMoney', 'all_bank_sum', 'noincome_sum', 
            'noexpense_sum', 'userdata', 'total_fiat_expense', 'total_money_income', 
            'noincome_get_sum', 'noexpense_get_sum', 'date_now', 'asc_value_income', 'desc_value_income', 
            'average_value_income', 'asc_value_expense', 'desc_value_expense', 'average_value_expense', 
            'total_all_transc', 'all_trans'));

        //return view('dashboard');
    })->name('dashboard');
});

//Link path files
Route::get('/get_mn_no_income', [ControllerLink::class, 'getMnNoIncome'])->name('get_mn_no_income');
Route::get('/get_mn_no_expense', [ControllerLink::class, 'getMnNoExpense'])->name('get_mn_no_expense');
Route::get('/add-transcation', [ControllerLink::class, 'addTranscation'])->name('add_transcation');
Route::get('/edit-fiat', [ControllerLink::class, 'editFiat'])->name('edit_fiat');
Route::get('/edit-bank', [ControllerLink::class, 'editBank'])->name('edit_bank');
Route::get('/add-bank', [ControllerLink::class, 'addBank'])->name('add_bank');
Route::get('/edit-manage-bank', [ControllerLink::class, 'editManageBank'])->name("edit_manage_bank");
Route::get('/delete-bank', [ControllerLink::class, 'deleteBank'])->name("delete_bank");
Route::get('/edit-no-income', [ControllerLink::class, 'editNoIncome'])->name('edit_no_income');
Route::get('/edit-no-expense', [ControllerLink::class, 'editNoExpense'])->name('edit_no_expense');
Route::get('/add-no-income', [ControllerLink::class, 'addNoIncome'])->name('add_no_income');
Route::get('/add-no-expense', [ControllerLink::class, 'addNoExpense'])->name('add_no_expense');
Route::get('/edit-mn-no-income', [ControllerLink::class, 'editMnNoIncome'])->name('edit_mn_no_income');
Route::get('/edit-mn-no-expense', [ControllerLink::class, 'editMnNoExpense'])->name('edit_mn_no_expense');
Route::get('/delete-ac-no-income', [ControllerLink::class, 'deleteAcNoIncome'])->name('delete_ac_no_income');
Route::get('/delete-ac-no-expense', [ControllerLink::class, 'deleteAcNoExpense'])->name('delete_ac_no_expense');
Route::get('/add-transaction-bank', [ControllerLink::class, 'addTransactionBank'])->name('add_transaction_bank');
Route::get('/generate-pdf', [updownController::class, 'generatePDF'])->name('generate-pdf');

//save Form
Route::post('/save-transcation', [ControllerLink::class, 'saveTransaction'])->name('save_transcation');
Route::post('/save-transcation-bank', [ControllerLink::class, 'saveTransactionBank'])->name('save_transcation_bank');
Route::post('/update-fiat', [ControllerLink::class, 'updateFiat'])->name('update_fiat');
Route::post('/add-ac-bank', [ControllerLink::class, 'addAcBank'])->name('add_ac_bank');
Route::post('/update-bank', [ControllerLink::class, 'updateBank'])->name('update_bank');
Route::post('/submit-delete-bank', [ControllerLink::class, 'submitDeleteBank'])->name('submit_delete_bank');
Route::post('/add-ac-no-income', [ControllerLink::class, 'addAcNoIncome'])->name('add_ac_no_income');
Route::post('/add-ac-no-expense', [ControllerLink::class, 'addAcNoExpense'])->name('add_ac_no_expense');
Route::post('/update-ac-no-income', [ControllerLink::class, 'updateAcNoIncome'])->name('update_ac_no_income');
Route::post('/update-ac-no-expense', [ControllerLink::class, 'updateAcNoExpense'])->name('update_ac_no_expense');
Route::post('/get-no-income', [ControllerLink::class, 'getNoIncome'])->name('get_no_income');
Route::post('/get-no-expense', [ControllerLink::class, 'getNoExpense'])->name('get_no_expense');
Route::post('/submit-delete-no-income', [ControllerLink::class, 'submitDeleteNoIncome'])->name('submit_delete_no_income');
Route::post('/submit-delete-no-expense', [ControllerLink::class, 'submitDeleteNoExpense'])->name('submit_delete_no_expense');


?>