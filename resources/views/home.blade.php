@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">BDA Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! <br>

                        <b>Below are menu of BDA dashboard </b><br><br>

                    <a href="{{ route('employees.index') }}" class="align-content-end">Employees</a>
                    <br>
                    <a href="{{ route('companies.index') }}" class="align-content-end">Companies</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
