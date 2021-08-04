<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\FeesClearanceController;
use App\Http\Controllers\ExamResultController;

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

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::get('/my-results', [ExamResultController::class, 'myresults'])->name('my-results');
    Route::get('/results/clearance/{user:slug}', [ExamResultController::class, 'show'])->name('my-clearance');
    //for accounts
    Route::get('/dashboard/fees-clearances', [FeesClearanceController::class, 'index'])->name('fees-clearances');
    Route::get('/dashboard', [FeesClearanceController::class, 'index'])->name('dashboard');

    Route::get('/practice', function(){
        return view('practice');
    });
});
// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
