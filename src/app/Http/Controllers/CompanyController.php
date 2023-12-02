<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Helper;

class CompanyController extends Controller
{
    /**
     * Display a list of companies.
     */
    public function index()
    {
        $companies = Company::orderBy('id','desc')->paginate(5);

        return view('companies.index',compact('companies'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new company.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created company in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:100|unique:companies',
            'email' => 'required|min:5|max:50|email',
            'address' => 'required|min:5|max:255|',
            'subdomain' => 'required|alpha_num:ascii|min:3|max:20|unique:companies',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();
        $fileName = $input['name'] . '.' . $request->logo->extension();
        $path = $request->logo->storeAs('logos', $fileName, 'public');
        $input['logo'] = $path;

        Company::create($input);

        return redirect()->route('companies.index')
            ->with('success','Company created successfully.');
    }

    /**
     * Display the specified company.
     */
    public function show(Company $company)
    {
        return view('companies.show',compact('company'));
    }

    public function subdomain(Company $company)
    {
        return view('companies.show',compact('company'));
    }

    /**
     * Show the form for editing the specified company.
     */
    public function edit(Company $company)
    {
        return view('companies.edit',compact('company'));
    }

    /**
     * Update the specified company in storage.
     */
    public function update(Request $request, Company $company)
    {
        $input = $request->all();

        if($input['name'] == $company->name) {
            $request->validate([
                'name' => 'required|min:3|max:100',
            ]);
        } else {
            $request->validate([
                'name' => 'required|min:3|max:100|unique:companies',
            ]);
        }

        if($input['subdomain'] == $company->subdomain) {
            $request->validate([
                'subdomain' => 'required|alpha_num:ascii|min:3|max:20',
            ]);
        } else {
            $request->validate([
                'subdomain' => 'required|alpha_num:ascii|min:3|max:20|unique:companies',
            ]);
        }

        $request->validate([
            'email' => 'required|min:5|max:50|email',
        ]);

        if ($logo = $request->file('logo')) {
            $fileName = $input['name'] . '.' . $request->logo->extension();
            $path = $request->logo->storeAs('logos', $fileName, 'public');

            $input = $request->all();
            $input['logo'] = $path;

        }else{
            unset($input['logo']);
        }

        $company->update($input);

        return redirect()->route('companies.index')
            ->with('success','Company updated successfully');
    }

    /**
     * Remove the specified company from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')
            ->with('success','Company deleted successfully');
    }
}
