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
        $user = auth()->user(); // ดึงข้อมูลผู้ใช้ที่ล็อกอินอยู่
        $wallet_bank = DB::table('bank')->select('wallet_bank')->where('id', $user->id)->get();
        return view('dashboard', compact('wallet_bank'));

        //return view('dashboard');
    })->name('dashboard');
});

//Link path files
Route::get('/add-transcation', [ControllerLink::class, 'addTranscation'])->name('add_transcation');
Route::get('/edit-fiat', [ControllerLink::class, 'editFiat'])->name('edit_fiat');

//save Form
Route::post('/save-transcation', [ControllerLink::class, 'saveTransaction'])->name('save_transcation');
Route::post('/update-fiat', [ControllerLink::class, 'updateFiat'])->name('update_fiat');

?>