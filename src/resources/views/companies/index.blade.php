@extends('companies.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Companies</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('companies.create') }}"> Create New Company</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Logo</th>
            <th>Name</th>
            <th>e-mail</th>
            <th>Address</th>
            <th>Subdomain</th>
            <th>Action</th>
        </tr>
        @foreach ($companies as $company)
            <tr>
                <td>{{ ++$i }}</td>
                <td>
                    <img src="{{ asset("storage/$company->logo") }}" width="100px" alt="{{$company->name}}" onerror="this.onerror=null;this.src='{{ asset("storage/logos/not-found.jpg") }}';">
                </td>
                <td>{{ $company->name }}</td>
                <td>{{ $company->email }}</td>
                <td>{{ $company->address }}</td>
                <td>{{ $company->subdomain }}</td>
                <td width="380px">
                    <form action="{{ route('companies.destroy',$company->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('companies.show', $company->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('companies.edit', $company->id) }}">Edit</a>

                        <a class="btn btn-primary" href="{{ \App\Helpers\insert_subdomain(Request::getSchemeAndHttpHost(), $company->subdomain) }}">Subdomain</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $companies->links() !!}

@endsection
