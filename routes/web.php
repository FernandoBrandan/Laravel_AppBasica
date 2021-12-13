<?php

use App\Http\Controllers\ResumeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('resume.create');
})->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::resource('resumes', ResumeController::class);  //Reemplazaa a todo

Route::get('/resume/create', [ResumeController::class,'create'])->name('resume.create');
Route::post('/resume/store', [ResumeController::class,'store'])->name('resume.store');
Route::get('/resume/index', [ResumeController::class,'index'])->name('resume.index');

Route::get('/resume/{resume}/edit', [ResumeController::class,'edit'])->name('resume.edit');
Route::put('/resume/{resume}', [ResumeController::class,'update'])->name('resume.update');

Route::delete('/resume/{resume}', [ResumeController::class,'destroy'])->name('resume.destroy');

Route::get('/resume/{resume}', [ResumeController::class,'show'])->name('resume.show');

