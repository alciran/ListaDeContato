<?php

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

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login/access', [App\Http\Controllers\AuthController::class, 'login'])->name('login.access');

Route::POST('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

Route::middleware('auth')->group(function () {    

    Route::get('/', function () {
        return redirect()->route('home');
    });
    
    Route::get('/home', [App\Http\Controllers\ContactController::class, 'index'])->name('home');

    Route::middleware('contactAccess')->group(function () {
        Route::resource('contato', App\Http\Controllers\ContactController::class);
    });

});

    


/* Route::prefix('/contato')->group(function () {
    Route::get('/', [App\Http\Controllers\ContactController::class, 'index'])->name('contato');
    Route::get('/create', [App\Http\Controllers\ContactController::class, 'create'])->name('contato.create');
    Route::post('/store', [App\Http\Controllers\ContactController::class, 'store'])->name('contato.store');
    Route::get('/edit/{id}', [App\Http\Controllers\ContactController::class, 'edit'])->name('contato.edit');
    Route::put('/update/{id}', [App\Http\Controllers\ContactController::class, 'update'])->name('contato.update');
    Route::delete('/delete/{id}', [App\Http\Controllers\ContactController::class, 'destroy'])->name('contato.destroy');
}); */

//Auth::routes();


