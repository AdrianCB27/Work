<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrabajadorController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('index', function () {
    return view('trabajadores.index');
});

Route::get('trabajadores', [TrabajadorController::class, 'index'])->name('trabajadores.index');
Route::post('trabajadores', [TrabajadorController::class, 'filter'])->name('trabajadores.filter');


Route::get('trabajadores/create', [TrabajadorController::class, 'create'])->name('trabajadores.create');
Route::post('trabajadores/store', [TrabajadorController::class, 'store'])->name('trabajadores.store');

Route::get('trabajadores/edit/{id}', [TrabajadorController::class, 'edit'])->name('trabajadores.edit');
Route::put('trabajadores/update/{id}', [TrabajadorController::class, 'update'])->name('trabajadores.update');

Route::delete('trabajador/{id}', [TrabajadorController::class, 'destroy'])->name('trabajadores.delete');
Route::get('trabajador/{id}', [TrabajadorController::class, 'show'])->name('trabajadores.show');