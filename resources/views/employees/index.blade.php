@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Employee List</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('employees.create') }}"> Create New Employee</a>
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
            <th>Name</th>
            <th>Email</th>
            <th>Company</th>
            <th width="280px">Action</th>
        </tr>

        @foreach ($employeeList as $employee)
            <tr>
                <td>{{ $employee->fullName ?? '' }}</td>
                <td>{{ $employee->email ?? '' }}</td>
                <td>{{ $employee->company->name ?? '' }}</td>
                <td>
                    <form action="{{ route('employees.destroy',$employee->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('employees.show',$employee->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('employees.edit',$employee->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

{{--    {!! $products->links() !!}--}}

@endsection
