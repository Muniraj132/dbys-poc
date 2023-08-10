<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ExportController;
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
    return view('auth.login');
});

Auth::routes();


Route::group(['middleware' => 'auth'], function(){
   
    Route::get('/Dbys/admin-Dashboard', [HomeController::class, 'index'])->name('home');

    
     Route::get('/Dbys/Events', [EventController::class, 'index']);
     Route::get('/Dbys/Add-Event', [EventController::class, 'addevent']);
     Route::get('/Dbys/Edit-Event/{id}', [EventController::class, 'EditEventdata']);
     Route::post('EventStore', [EventController::class, 'EventStore']);
     Route::post('EventUpdate', [EventController::class, 'EventUpdate']);
     Route::get('eventdata', [EventController::class, 'geteventdata']);
     Route::get('eventdatedelete',[EventController::class, 'deleteevent']);

     //user module
     Route::get('userdata', [HomeController::class, 'userdata']);
     Route::get('userdatedelete',[HomeController::class, 'deleteuser']);
     Route::get('Dbys/Get-Users', [HomeController::class, 'getusers']);
     Route::post('Dbys/Update-Users', [HomeController::class, 'UpdateUsers']);
     Route::post('addUser',[HomeController::class,'adduser']);
    // export user
    Route::get('exportXlxs', [ExportController::class,'exportXlxs'])->name('exportXlxs');

});

Route::get('logout', function ()
{
    auth()->logout();
    Session()->flush();
    return Redirect::to('/');
})->name('logout');
