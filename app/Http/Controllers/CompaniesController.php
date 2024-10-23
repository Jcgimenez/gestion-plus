<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompaniesController extends Controller
{
    public function index()
    {
        $companies = Companies::all();
        $userId = Auth::user()->id;
        $user = User::find($userId);
        return view('companies.index', compact('companies', 'user'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $companiesInfo = CompaniesInfo::create([
            'name' => $request->name,
        ]);
    
        Companies::create([
            'name' => $request->name,
            'companies_id' => $companiesInfo->id, 
            'user_id' => $request->user_id,
            'monthly_earnings' => $request->monthly_earnings,
            'hours_worked' => $request->hours_worked,
        ]);
    
        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }    

    public function show(Companies $companies)
    {
        return view('companies.show', compact('companies'));
    }

    public function edit(Companies $companies)
    {
        return view('companies.edit', compact('companies'));
    }

    public function update(Request $request, Companies $company)
    {
        $request->validate([
            'name' => 'required',
            'monthly_earnings' => 'required|numeric',
            'hours_worked' => 'required|numeric',
        ]);
    
        // Actualizar los campos
        $company->update([
            'name' => $request->input('name'),
            'monthly_earnings' => $request->input('monthly_earnings'),
            'hours_worked' => $request->input('hours_worked'),
        ]);
    
        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }    

    public function destroy(Companies $companies)
    {
        $companies->delete();

        return redirect()->route('companies.index')->with('success', 'Companies deleted successfully.');
    }
}
