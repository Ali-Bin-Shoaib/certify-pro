<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProgramController;
use App\Models\Category;
use App\Models\Program;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\VarDumper\VarDumper;

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
    return view('index');
})->name('home');

Route::redirect('/index', '/');
Route::redirect('/home', '/');
Route::get('/verify', [PDFController::class, 'verify'])->name('verify');

Route::get('/signup', [ AuthController::class, 'signup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
// Route::post('/login', function (){
//     return redirect()->action('MemberAuthController');
// });


Route::group(['middleware' => 'auth'], function () {
    Route::resource('programs', ProgramController::class);
    Route::resource('participants', ParticipantController::class);
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/pdf', [PDFController::class, 'generatePdf'])->name('pdf');
    Route::get('/preview', [PDFController::class, 'previewPdf'])->name('preview');
});
// Auth::routes();