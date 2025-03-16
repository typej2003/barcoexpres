<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Compra\ListCompras;

Route::get('/listCompras', ListCompras::class)->name('listCompras')->middleware('auth');