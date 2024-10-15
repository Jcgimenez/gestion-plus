<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/incomes', [IncomeController::class, 'store']);
Route::post('/expenses', [ExpenseController::class, 'store']);

