<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BelajarLaravelController;

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

Route::get('/logout', [BelajarLaravelController::class, 'logout'])->name('logout');
//todo
Route::middleware('isGuest')->group(function(){
    Route::get('/', [BelajarLaravelController::class, 'index']);
    Route::get('/register', [BelajarLaravelController::class, 'register'])->name('register.page');
    Route::get('/login', [BelajarLaravelController::class, 'login']);
    Route::post('/register/input', [BelajarLaravelController::class, 'registerAccount'])->name('register.input');
    Route::post('/login/auth', [BelajarLaravelController::class, 'auth'])->name('login.auth');
});

Route::middleware('isLogin')->group(function(){    
    Route::get('/dashboard', [BelajarLaravelController::class, 'dashboard'])->name('dashboard');   
    Route::get('/create', [BelajarLaravelController::class, 'create'])->name('create');
    Route::post('/store', [BelajarLaravelController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [BelajarLaravelController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [BelajarLaravelController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [BelajarLaravelController::class, 'destroy'])->name('delete');
    Route::patch('/complated/{id}', [BelajarLaravelController::class, 'updateComplated'])->name('updateComplated');
});


