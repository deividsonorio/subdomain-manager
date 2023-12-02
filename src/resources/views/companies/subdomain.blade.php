@extends('companies.layout')

@section('content')
    <div class="col-lg-8 mx-auto p-4 py-md-5">
        <header class="d-flex align-items-center pb-3 mb-5 border-bottom">
            <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                <img src="{{ asset("storage/$company->logo") }}" width="100px">
                <span class="fs-4 p-4">{{$company->name}}</span>
            </a>
        </header>

        <main>
            <h1>Welcome to the {{$company->name}} page</h1>
            <p class="fs-5 col-md-8">This is an example subdomain page for the {{$company->name}} company.</p>

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
        <footer class="pt-5 my-5 text-muted border-top">
            Created by Deivid S. Onorio &middot; &copy; 2023
        </footer>
    </div>

    </body>
    </html>
@endsection
