<?php
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ControllerLink;

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

        //Show No expense to Dashboard
        $noexpense_sum = DB::table('no_expense')
        ->where('user_name', $userdata[0]->name)
        ->sum('wallet_noexpense');

        //Show Total fiat - total expense
        $fiatwallet = $userdata[0]->fiat_wallet;
        
        $total_sum_expense = DB::table('transcations')
        ->where('user_name', $userdata[0]->name)
        ->where('type', 'expense')
        ->sum('value');

        $total_fiat_expense = $fiatwallet;

        return view('dashboard', compact('name', 'bankMoney', 'all_bank_sum', 'noincome_sum', 'noexpense_sum', 'userdata', 'total_fiat_expense'));

        //return view('dashboard');
    })->name('dashboard');
});

//Link path files
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


//save Form
Route::post('/save-transcation', [ControllerLink::class, 'saveTransaction'])->name('save_transcation');
Route::post('/update-fiat', [ControllerLink::class, 'updateFiat'])->name('update_fiat');
Route::post('/add-ac-bank', [ControllerLink::class, 'addAcBank'])->name('add_ac_bank');
Route::post('/update-bank', [ControllerLink::class, 'updateBank'])->name('update_bank');
Route::post('/submit-delete-bank', [ControllerLink::class, 'submitDeleteBank'])->name('submit_delete_bank');
Route::post('/add-ac-no-income', [ControllerLink::class, 'addAcNoIncome'])->name('add_ac_no_income');
Route::post('/add-ac-no-expense', [ControllerLink::class, 'addAcNoExpense'])->name('add_ac_no_expense');
Route::post('/update-ac-no-income', [ControllerLink::class, 'updateAcNoIncome'])->name('update_ac_no_income');
Route::post('/update-ac-no-expense', [ControllerLink::class, 'updateAcNoExpense'])->name('update_ac_no_expense');


?>