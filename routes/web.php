<?php

use App\Http\Controllers\AturanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiagnosaController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\PenyakitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SolusiController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Welcome
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

});

/*
|--------------------------------------------------------------------------
| Admin Only
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    Route::resource('penyakit', PenyakitController::class);

    Route::resource('gejala', GejalaController::class);

    Route::resource('solusi', SolusiController::class);

    Route::resource('aturan', AturanController::class);

    Route::get('/users', function () {
        $users = User::all();

        return view('users.index', compact('users'));
    })->name('users.index');

});

/*
|--------------------------------------------------------------------------
| User & Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/diagnosa', [DiagnosaController::class, 'index']);

    Route::post('/diagnosa', [DiagnosaController::class, 'proses']);

    Route::get('/riwayat-diagnosa', [DiagnosaController::class, 'riwayat']);

    Route::get('/riwayat-diagnosa/{id}', [DiagnosaController::class, 'detail']);

    Route::get('/riwayat-diagnosa/{id}/pdf', [DiagnosaController::class, 'downloadPdf']);

});

require __DIR__.'/auth.php';
