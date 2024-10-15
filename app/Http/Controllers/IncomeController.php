<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'amout' => 'required|numeric',
        ]);

        Income::create($request->all());

        return response()->json(['message' => 'Income added successfully']);
    }
}
