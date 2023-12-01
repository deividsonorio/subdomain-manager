<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Models\Company;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home and company routes
Route::domain('localhost')->group(function () {
    Route::get('/', function() {
        return 'teste';
    });
    Route::resource('companies', CompanyController::class);
});

// Subdomain routes
Route::domain('{subdomain}.localhost')->group(function () {
    Route::get('/', function($subdomain) {
        $company = Company::where('subdomain', $subdomain)->firstOrFail();
        return view('companies.show',compact('company'));
    });
});


