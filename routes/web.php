<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\Auth\LoginController;



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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

//Route::get('/login','LoginController@showLoginForm')->name('login');
//Route::post('/admin/dashboard','LoginController@login')->name('login.submit');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/admin/dashboard', [LoginController::class, 'login'])->name('login.submit');



Route::get('/', [NavigationController::class, 'home'])->name('home');
Route::post('/login', [NavigationController::class, 'login'])->name('login');
Route::get('/signup', [NavigationController::class, 'signup'])->name('signup');

// Route::prefix('admin')->middleware(['auth'])->group(function () { removed middleware for testing
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/request-claim', [AdminController::class, 'requestClaim'])->name('admin.request-claim');
    Route::get('/approved-claims', [AdminController::class, 'approvedClaims'])->name('admin.approved-claims');
    Route::get('/rejected-claims', [AdminController::class, 'rejectedClaims'])->name('admin.rejected-claims');
});

Route::prefix('lab')->group(function(){
    Route::get('/dashboard', [LabController::class, 'dashboard'])->name('Lab.dashboard');
    Route::get('/patient_list', [LabController::class, 'patient_list'])->name('Lab.patient_list');
    Route::post('/patient_list', [LabController::class, 'markAsDone'])->name('Lab.patient_list.markAsDone');
    Route::get('/upload_reports', [LabController::class, 'upload_reports_view'])->name('Lab.upload_reports_view');
    Route::post('/uploadreports', [LabController::class, 'uploadReport'])->name('upload.report');
    Route::get('/upload_bills', [LabController::class, 'upload_bills_view'])->name('Lab.upload_bills_view');
    Route::post('/upload_bills', [LabController::class, 'uploadBill'])->name('upload.bill');
});

Route::post('/logout', function () {
    // Auth::logout(); commented out for testing
    return redirect()->route('login');
})->name('logout');
