<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/incomes/{id}/edit', [IncomeController::class, 'edit']);
Route::put('/incomes/{id}', [IncomeController::class, 'update']);

Route::get('/expenses/{id}/edit', [ExpenseController::class, 'edit']);
Route::put('/expenses/{id}', [ExpenseController::class, 'update']);