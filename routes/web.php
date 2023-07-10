<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FileController;
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

Route::get('/', [FileController::class, 'index'])->name('index');
Route::post('/', [FileController::class, 'uploads'])->name('uploads');

Route::get('/file/{id}', [FileController::class, 'find'])->name('find');


Route::get('/live',function(){
return view('liv');
});



// adminStep
Route::get('/admin', [AdminController::class, 'index'])->name('admin_dashboard');


Route::post('/login', [AdminController::class, 'login'])->name('admin_login');
// 


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
