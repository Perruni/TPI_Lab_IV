<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/index', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/fullcalendar', function () {
    return view('fullcalendar');
});


use App\Http\Controllers\permisoscontroller;

Route::get('/permisos', [permisoscontroller::class, 'index'])->name('evento.detallesevento');

use App\Http\Controllers\Eventocontroller;
use Illuminate\Types\Relations\Role;

Route::middleware('auth')->group(function () {
Route::get('/evento/miseventos', [eventocontroller::class, 'index'])->name('evento.miseventos');
Route::get('/evento/nuevoevento',[eventocontroller::class, 'cargar'])->name('evento.cargar');
Route::post('/evento/guardar',[eventocontroller::class, 'guardar'])->name('evento.guardar');
});



use App\Http\Controllers\EventController;

Route::post('/ruta-para-guardar-evento', [EventController::class, 'store']);

Route::get('/crear-evento', function () {
    return view('create-event');
});

