<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\FeesClearanceController;
use App\Http\Controllers\ExamResultController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\CandidateController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => ['auth:sanctum','prevent-back-history','activate','verified']], function(){
    Route::get('/my-results', [ExamResultController::class, 'myresults'])->name('my-results');
    Route::post('/my-results', [ExamResultController::class, 'myexamResults'])->name('my-result');
    Route::get('/results/clearance/{user:slug}', [ExamResultController::class, 'show'])->name('my-clearance');
    Route::get('/results/upload-csv',[ExamResultController::class, 'uploadCsv'])->name('results-csv');
    //for accounts
    Route::get('/dashboard/fees-clearances', [FeesClearanceController::class, 'index'])->name('fees-clearances');
    Route::get('/dashboard', [FeesClearanceController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/fees-clearances/{user:slug}', [FeesClearanceController::class, 'show'])->name('fees-clearance');
    Route::get('/users/registration', [UserController::class, 'create'])->name('user-registration');
    Route::post('/users/registration', [UserController::class, 'store']);
    Route::get('/statistics',[StatisticsController::class, 'index'])->name('statistics');
    Route::get('/candidates',[CandidateController::class, 'index'])->name('candidates');    
        
    Route::get('/practice', function(){
        return view('practice');
    });
    
});
    Route::get('/users/activate-account',[UserController::class, 'activate'])->name('account-activation');
    Route::put('/users/activate-account',[UserController::class, 'activation']);
// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify'); 

Route::get('/_84FF3D5A427A459C6541D9CA83370A79.178.79.149.58', function(){
    return 'DF67AEFE949D6B4280B85A2D7B13FC1E.27BCA970DA5891593E26550872CAD260.b332f55cb1a1994.comodoca.com';
});