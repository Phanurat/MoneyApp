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
        $userdata = DB::table('users')->select('name', 'id')->where('id', $user->id)->get();

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

        return view('dashboard', compact('name', 'bankMoney'));

        //return view('dashboard');
    })->name('dashboard');
});

//Link path files
Route::get('/add-transcation', [ControllerLink::class, 'addTranscation'])->name('add_transcation');
Route::get('/edit-fiat', [ControllerLink::class, 'editFiat'])->name('edit_fiat');
Route::get('/edit-bank', [ControllerLink::class, 'editBank'])->name('edit_bank');

//save Form
Route::post('/save-transcation', [ControllerLink::class, 'saveTransaction'])->name('save_transcation');
Route::post('/update-fiat', [ControllerLink::class, 'updateFiat'])->name('update_fiat');

?>