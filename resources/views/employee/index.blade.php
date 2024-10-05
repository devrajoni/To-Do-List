@extends('layouts.master')
@section('content')
    <div class="content-page mb-5" style="min-height: calc(100vh - 240px);">
        <div class="container-fluid">

            <div class="card mt-5" style="border-radius: 10px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="box-body">
                                <table class="table responsive">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($employees as $employee)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $employee->name }}</td>
                                                <td>{{ $employee->email }}</td>
                                                <td>
                                                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-info"><i class="ph-pencil"></i></a>
                                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this employee?');"><i class="ph-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
