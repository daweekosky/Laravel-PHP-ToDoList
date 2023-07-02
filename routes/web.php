<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DoneController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/form', function () {
    return view('form');
})->middleware(['auth', 'verified'])->name('form');



Route::get('/dashboard', [TaskController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/donetasks', [DoneController::class,'index'])->middleware(['auth', 'verified'])->name('donetasks');

Route::get('/delete/{id}',[TaskController::class,'destroy'])->name('delete');

Route::get('/edit/{id}', [TaskController::class,'edit'])->name('edit');
Route::put('/update/{id}', [TaskController::class,'update'])->name('update');

Route::get('/update2/{id}', [TaskController::class,'update2'])->name('update2');

Route::post('/form',[TaskController::class,'store'])->name('store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
