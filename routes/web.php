<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\TemplateController;
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

Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/certificate-verify/{certificateId?}', [CertificateController::class, 'certificateVerify'])->name('certificateVerify');

Route::group(['middleware' => 'organization'], function () {

    Route::get('organizations/{organizationId}/edit',[OrganizationController::class, 'edit'])->name('organizations.edit');
    Route::resource('members', MemberController::class);
});

Route::group(['middleware' => 'member'], function () {
    Route::resource('programs', ProgramController::class);

    Route::get('/participants/create/{programId?}', [ParticipantController::class, 'create'])->name('participants.create');
    Route::post('/participants/store/{programId?}', [ParticipantController::class, 'store'])->name('participants.store');
    Route::resource('participants', ParticipantController::class)->except(['create', 'store']);

    Route::resource('trainers', TrainerController::class);

    Route::resource('categories', CategoryController::class)->except('show');

    Route::get('/certificate/{programId}/{participantId}', [CertificateController::class, 'certificateGenerate'])->name('certificateGenerate');
    Route::get('/certificate-preview/{programId}/{participantId}', [CertificateController::class, 'certificatePreview'])->name('certificatePreview');
    Route::get('template/create/{programId}', [TemplateController::class, 'create'])->name('template.create');
    Route::post('template/store/{programId}', [TemplateController::class, 'store'])->name('template.store');
    Route::get('template/edit/{programId}', [TemplateController::class, 'edit'])->name('template.edit');
    Route::put('template/update/{programId}', [TemplateController::class, 'update'])->name('template.update');
    Route::delete('template/{programId}', [TemplateController::class, 'destroy'])->name('template.destroy');
    // Route::get('/certificate-verify/{certificateId?}', [CertificateController::class, 'certificateVerify'])->name('certificateVerify');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
