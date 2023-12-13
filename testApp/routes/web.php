<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\LecturerController;

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
Route::get('/coba', [CobaController::class, 'test']);
Route::view('/view', 'tampilan');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['role:admin|user']], function () {
    Route::get('/data', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('data');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('user')
    ->name('user.')
    ->group(function() {
        Route::get('/unsur/{name?}', function(string $name=null){
            if($name == null) {
                return "hello there .. ";
            } else {
                return "hello ".$name;
            }
        })->name('test');
});


Route::get('/test-lagi', function () {
    return view('test'); 
});

Route::prefix('lecturer')
    ->name('lecturer.')
    ->group(function() {
        Route::get('/', [LecturerController::class, 'index'])->name('index');
        Route::get('/create', [LecturerController::class, 'create'])->name('create');
        Route::post('/store', [LecturerController::class, 'store'])->name('store');
        Route::get('/{nidn}/edit', [LecturerController::class, 'edit'])->name('edit');
        Route::patch('/{nidn}/update', [LecturerController::class, 'update'])->name('update');
        Route::delete('/{nidn}/delete', [LecturerController::class, 'destroy'])->name('destroy');

        // relationship
        Route::get('/{nidn}/students', [LecturerController::class, 'lecturer_student'])->name('students');

        // mail
        Route::get('/sentMail', [LecturerController::class, 'sentMail'])->name('sent.mail');
});

require __DIR__.'/auth.php';