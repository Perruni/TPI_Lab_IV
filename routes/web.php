<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('login');
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

Route::middleware('auth')->group(function () {
    Route::get('/permisos', [permisoscontroller::class, 'index'])->name('evento.detallesevento');

});

use App\Http\Controllers\Eventocontroller;
use Illuminate\Types\Relations\Role;

Route::middleware('auth')->group(function () {

Route::get('/miseventos', [eventocontroller::class, 'index'])->name('miseventos');
Route::get('/nuevoevento',[eventocontroller::class, 'cargar'])->name('cargar');
Route::post('/guardar',[eventocontroller::class, 'guardar'])->name('guardar');
Route::get('/edit/{id}', [eventocontroller::class, 'edit'])->name('edit');
Route::put('/update/{id}',[eventocontroller::class, 'update'])->name('update');
Route::delete('/borrar/{id}',[eventocontroller::class, 'borrar'])->name('borrar');
Route::get('/eventos/{id}', [eventoController::class, 'EventoDetallado'])->name('eventodetallado');
Route::get('/buscar-eventos', [eventoController::class, 'buscarEventos'])->name('eventos.buscar');
Route::post('/eliminar-invitado/{invitacionId}', [eventoController::class, 'eliminarInvitado'])->name('eliminar-invitado');

Route::get('/mostrarEventos', [EventoController::class, 'mostrarEventosView'])->name('mostrarEventos');

});
Route::middleware('auth')->group(function () {
    Route::get('/fullcalendar', [eventocontroller::class, 'fullCalendar'])->name('fullcalendar');
});

Route::get('/api/google-maps-key', function () {
    return response()->json(['apiKey' => config('services.google_maps.api_key')]);
});

use App\Http\Controllers\invitacioncontroller;

Route::middleware('auth')->group(function () {
    Route::get('/invitar/{eventoId}', [invitacioncontroller::class, 'invitar'])->name('invitar');
    Route::get('/buscarinvitados', [invitacioncontroller::class, 'buscarinvitados'])->name('buscarinvitados');
    Route::post('/enviarinvitacion', [invitacioncontroller::class, 'enviarinvitacion'])->name('enviarinvitacion');
    Route::get('/misinvitaciones', [invitacioncontroller::class, 'misinvitaciones'])->name('misinvitaciones');
    Route::post('/aceptar/{InvitacionID}', [invitacioncontroller::class, 'aceptar'])->name('aceptar');
    Route::post('/rechazar/{InvitacionID}', [invitacioncontroller::class, 'rechazar'])->name('rechazar');
});



Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');
