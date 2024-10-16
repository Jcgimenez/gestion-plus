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
            'bank_id' => 'required|exists:banks,id',
            'location' => 'required|string',
        ]);

        Expense::create($request->all());

        return response()->json(['message' => 'Expense added succesfully']);
    }

    public function edit($id)
    {
        $expense = Expense::findOrFail($id);

        return view('expenses.edit', compact('expense'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
            'amount' => 'required|numeric',
            'bank_id' => 'required|exists:banks,id',
            'location' => 'required|string',
        ]);

        $expense = Expense::findOrFail($id);

        $expense->update($request->all());

        return response()->json(['message' => 'Expense updated succesfully']);
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
