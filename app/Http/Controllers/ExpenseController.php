<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'amount' => 'required|numeric',
        ]);

        Expense::create($request->all());

        return response()->json(['message' => 'Expense added succesfully']);
    }
}
