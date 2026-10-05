<?php

use Illuminate\Support\Facades\Route;

Route::get('/easteregg', function () {
    return view('easteregg');
});

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/data-kas', function () {
    return view('kas-data');
});

Route::get('/pemasukan', function () {
    return view('incomes');
});

Route::get('/pengeluaran', function () {
    return view('expenses');
});