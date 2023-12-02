@extends('companies.layout')

@section('content')
    <main>
        <h1>Company: {{$company->name}}</h1>
        <div class="row row-cols-1 row-cols-md-1 mb-1 text-center">
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm">
                    <div class="card-header py-3">
                        <h4 class="my-0 fw-normal">Info</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title">{{$company->name}}</h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li><b>Address: </b>{{$company->address}}</li>
                            <li><b>E-mail: </b>{{$company->name}}</li>
                            <li><b>Subdomain: </b> {{$company->name}} </li>
                            <li><b>Logo</b></li>
                            <li><img src="{{ asset("storage/$company->logo") }}" width="100px"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-5">
            <a href="{{ route('companies.index') }}" class="btn btn-primary btn-lg px-4">Companies creation</a>
        </div>
    </main>
@endsection
