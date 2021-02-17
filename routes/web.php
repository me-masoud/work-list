<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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



Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    //todo
    Route::get('/todo',[TodoController::class , 'index'])->middleware('auth');
    Route::post('/postmytask' , [TodoController::class , 'storeTask'])->middleware('auth');


// Route::get('gettasks' ,[TodoController::class,'index'])->middleware('auth');
Route::get('gettodaytasks' ,[TodoController::class,'getTodayTasks'])->middleware('auth');
Route::get('gettasks/{start}/{end}' ,[TodoController::class,'getTasks']);
