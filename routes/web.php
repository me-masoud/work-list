<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


use Auth\LoginController;
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
   return redirect('/lang/fa');
})->name('index');

Route::get('/clear-cache', function() {

    $configCache = Artisan::call('config:cache');
    $clearCache = Artisan::call('cache:clear');
    return 'cache cleared';
});


//auth
Auth::routes();

//end auth


//local
Route::get('/lang/{locale}' , function($locale){
    if (! in_array($locale, ['en','fa'])) {
        abort(400);
    }
    App::setLocale($locale);
// dd(App::currentLocale());
return view('index');
})->name('lang');
//end local


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//todo
Route::get('/todo',[TodoController::class , 'index'])->middleware('auth');
Route::post('/postmytask' , [TodoController::class , 'storeTask'])->middleware('auth');

Route::get('gettodaytasks' ,[TodoController::class,'getTodayTasks'])->middleware('auth');
Route::get('gettasks/{start}/{end}' ,[TodoController::class,'getTasks'])->middleware('auth');
Route::post('updatetask', [TodoController::class , 'updateTask'])->middleware('auth');
Route::post('deletetask', [TodoController::class , 'deleteTask'])->middleware('auth');


