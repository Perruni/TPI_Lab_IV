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

use App\Http\Controllers\permisoscontroller;

Route::get('/permisos', [permisoscontroller::class, 'index'])->name('evento.detallesevento');

use App\Http\Controllers\Eventocontroller;
use Illuminate\Types\Relations\Role;

Route::middleware('auth')->group(function () {
Route::get('/miseventos', [eventocontroller::class, 'index'])->name('miseventos');
Route::get('/nuevoevento',[eventocontroller::class, 'cargar'])->name('cargar');
Route::post('/guardar',[eventocontroller::class, 'guardar'])->name('guardar');
Route::get('/{id}/edit', [eventocontroller::class, 'edit'])->name('edit');
Route::put('/update/{id}',[eventocontroller::class, 'update'])->name('update');
Route::delete('/borrar/{id}',[eventocontroller::class, 'borrar'])->name('borrar');
});

Route::middleware('auth')->group(function () {
    Route::get('/fullcalendar', [Eventocontroller::class, 'fullCalendar'])->name('fullcalendar');
});







