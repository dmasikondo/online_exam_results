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


Route::group(['middleware' => ['auth:sanctum','prevent-back-history','suspended','verified']], function(){
    Route::get('/my-results', [ExamResultController::class, 'myresults'])->name('my-results');
    Route::post('/my-results', [ExamResultController::class, 'myexamResults'])->name('my-result');
    Route::get('/results/clearance/{user:slug}', [ExamResultController::class, 'show'])->name('my-clearance');
    Route::get('/results/upload-csv',[ExamResultController::class, 'uploadCsv'])->name('results-csv');
    //for accounts
    Route::get('/dashboard/fees-clearances', [FeesClearanceController::class, 'index'])->name('fees-clearances');
    Route::get('/dashboard', [FeesClearanceController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/fees-clearances/{user:slug}', [FeesClearanceController::class, 'show'])->name('fees-clearance');  
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/registration', [UserController::class, 'create'])->name('user-registration');
    Route::post('/users/registration', [UserController::class, 'store']); 
    Route::get('/users/{user:slug}', [UserController::class, 'show'])->name('user');
    Route::get('/users/is-suspended', [UserController::class, 'redirectIfSuspended']); 
    Route::get('/users-students', [UserController::class, 'userStudents'])->name('users-students'); 
    Route::get('/statistics',[StatisticsController::class, 'index'])->name('statistics');
    Route::get('/candidates',[CandidateController::class, 'index'])->name('candidates');    
    Route::get('/candidates/{result:candidate_number}',[CandidateController::class, 'show'])->name('candidate');    
        
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

/*Route::get('/.well-known/pki-validation/181DF768572E618DC8AF0EB84C95A107.txt', function(){
     return response()->file('storage/images/181DF768572E618DC8AF0EB84C95A107.txt');
});*/

