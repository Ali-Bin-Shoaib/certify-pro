<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\TrainerController;
use Illuminate\Support\Facades\Route;

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
Route::get('/verify', [CertificateController::class, 'verify'])->name('verify');

Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => 'organization'], function () {
    Route::resource('members', MemberController::class);
});

Route::group(['middleware' => 'member'], function () {
    Route::resource('programs', ProgramController::class);

    Route::get('/participants/create/{programId?}', [ParticipantController::class, 'create'])->name('participants.create');
    Route::post('/participants/store/{programId}', [ParticipantController::class, 'store'])->name('participants.store');
    Route::resource('participants', ParticipantController::class)->except(['create', 'store']);

    Route::resource('trainers', TrainerController::class);

    Route::resource('categories', CategoryController::class)->except('show');

    Route::get('/certificate/{programId}', [CertificateController::class, 'generateCertificate'])->name('generateCertificate');
    Route::get('/certificate-preview/{programId}', [CertificateController::class, 'previewCertificate'])->name('previewCertificate');
    Route::get('/certificate-verify/{certificateId?}', [CertificateController::class, 'verifyCertificate'])->name('verifyCertificate');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
