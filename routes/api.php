<?php

use App\Http\Controllers\DataKasController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use Illuminate\Support\Facades\Route;

Route::get('/data-kas', [DataKasController::class, 'index']);
Route::put('/data-kas/{absen}/{column}', [DataKasController::class, 'update']);
Route::post('/data-kas/add-column', [DataKasController::class, 'addColumn']);

Route::get('/incomes', [IncomeController::class, 'index']);
Route::post('/incomes', [IncomeController::class, 'store']);
Route::put('/incomes/{id}', [IncomeController::class, 'update']);
Route::delete('/incomes/{id}', [IncomeController::class, 'destroy']);

Route::get('/expenses', [ExpenseController::class, 'index']);
Route::post('/expenses', [ExpenseController::class, 'store']);
Route::put('/expenses/{id}', [ExpenseController::class, 'update']);
Route::delete('/expenses/{id}', [ExpenseController::class, 'destroy']);
