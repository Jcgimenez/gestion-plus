<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    public function index()
    {
        $banks = Bank::all();
        $userId = Auth::user()->id;
        $user = User::find($userId);
        return view('banks.index', compact('banks', 'user'));
    }

    public function create()
    {
        return view('banks.create');
    }

    public function store(Request $request)
    {

        $bankInfo = BankInfo::create([
            'name' => $request->name,
        ]);

        $user = Auth::user();
    
        Bank::create([
            'name' => $request->name,
            'bank_id' => $bankInfo->id, 
            'user_id' => $user->id,
        ]);

        return redirect()->route('banks.index')->with('success', 'Bank created successfully.');
    }

    public function show(Bank $bank)
    {
        return view('banks.show', compact('bank'));
    }

    public function edit(Bank $bank)
    {
        return view('banks.edit', compact('bank'));
    }

    public function update(Request $request, Bank $bank)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $bank->update($request->all());

        return redirect()->route('banks.index')->with('success', 'Bank updated successfully.');
    }

    public function destroy(Bank $bank)
    {
        $bank->delete();

        return redirect()->route('banks.index')->with('success', 'Bank deleted successfully.');
    }
}
