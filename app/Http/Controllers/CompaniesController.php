<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Companies::all();
        return view('companies.index', compact('companies'));
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

    public function update(Request $request, Companies $companies)
    {
        $request->validate([
            'name' => 'required',
            'companies_id' => 'required',
            'user_id' => 'required',
            'monthly_earnings' => 'required',
            'hours_worked' => 'required',
        ]);

        $companies->update($request->all());

        return redirect()->route('companies.index')->with('success', 'Companies updated successfully.');
    }

    public function destroy(Companies $companies)
    {
        $companies->delete();

        return redirect()->route('companies.index')->with('success', 'Companies deleted successfully.');
    }
}
