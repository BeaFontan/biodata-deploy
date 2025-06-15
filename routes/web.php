<?php

use App\Http\Controllers\SightingController;
use App\Http\Controllers\SpeciesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('loginFront'))->name('home');
Route::get('/login', fn() => view('auth/login'))->name('loginFront');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/cambiar-contrasinal', [UserController::class, 'showChangePasswordForm'])->name('changePasswordFront');

Route::middleware(['auth', 'role:scientist|admin'])->group(function () {
    //AUTH
    Route::put('/cambiar-contrasinal', [UserController::class, 'updatePassword'])->name('password.update');

    //SPECIES
    Route::get('/listado-especies', [SpeciesController::class, 'index'])->name('listSpeciesFront');
    Route::get('/especie/{species}', [SpeciesController::class, 'show'])->name('speciesFront');
    Route::get('/creacion-edicion-especie/{species?}', [SpeciesController::class, 'createOrEdit'])->name('createEditSpeciesFront');

    Route::post('/creacion-especie', [SpeciesController::class, 'storeSpecie'])->name('species.create');
    Route::patch('/edicion-especie/{species}', [SpeciesController::class, 'editSpecie'])->name('species.edit');
    Route::delete('/eliminar-especie/{species}', [SpeciesController::class, 'destroy'])->name('species.destroy');

    //SIGHTINGS
    Route::resource('species.sightings', SightingController::class);
});
