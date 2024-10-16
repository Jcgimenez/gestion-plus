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
            'bank_id' => 'required|exists:banks,id',
            'company' => 'required|string'
        ]);

        Income::create($request->all());

        return response()->json(['message' => 'Income added successfully']);
    }

    public function edit($id)
    {
        $income = Income::findOrFail($id);

        return view('income.edit', compact('income'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
            'amount' => 'required|numeric',
            'bank_id' => 'required|exists:banks,id',
            'company' => 'required|string',
        ]);

        $income = Income::findOrFail($id);

        $income->update($request->all());

        return response()->json(['message' => 'Income updated succesfully']);
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = $value;
        $this->attributes['amount_pesos'] = $value;
        $this->attributes['amount_dollars'] = $value / $this->getCurrentDollarRate();
    }
    
    private function getCurrentDollarRate()
    {
        return 1150; 
    }
    
}
