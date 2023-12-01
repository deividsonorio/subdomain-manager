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
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::orderBy('id','desc')->paginate(5);

        return view('companies.index',compact('companies'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:companies',
            'email' => 'required|email',
            'address' => 'required',
            'subdomain' => 'required|unique:companies',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $fileName = time() . '.' . $request->logo->extension();
        $path = $request->logo->storeAs('logos', $fileName, 'public');

        $input = $request->all();
        $input['logo'] = $path;

        Company::create($input);

        return redirect()->route('companies.index')
            ->with('success','Company created successfully.');
    }

    /**
     * Display the specified resource.
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
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('companies.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $input = $request->all();

        if($input['name'] == $company->name) {
            $request->validate([
                'name' => 'required',
            ]);
        } else {
            $request->validate([
                'name' => 'required|unique:companies',
            ]);
        }

        if($input['subdomain'] == $company->subdomain) {
            $request->validate([
                'subdomain' => 'required',
            ]);
        } else {
            $request->validate([
                'subdomain' => 'required|unique:companies',
            ]);
        }

        $request->validate([
            'email' => 'email',
        ]);

        if ($logo = $request->file('logo')) {
            $fileName = time() . '.' . $request->logo->extension();
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
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')
            ->with('success','Company deleted successfully');
    }
}
