<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Recursos\SubirImagen;

Route::get('/subirimagen', SubirImagen::class)->name('subirimagen');

Route::post('/guardarImagen', [SubirImagen::class, 'guardarImagen'])->name('guardarImagen');

Route::post('/deleteImagen', [SubirImagen::class, 'deleteImagen'])->name('deleteImagen');