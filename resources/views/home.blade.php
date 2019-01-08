@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped table-bordered">
                      <tr>
                        <td> <a href="/students" class="btn btn-primary"> View Students </a> </td>
                        <td> <a href="/students/create" class="btn btn-primary"> Add Student </a> </td>
                      </tr>

                      <tr>
                        <td> <a href="/attendance" class="btn btn-primary"> View Attendance </a> </td>
                        <td> <a href="/attendance/create" class="btn btn-primary"> Take Attendance </a> </td>
                      </tr>

                      <tr>
                        <td> <a href="/payments" class="btn btn-primary"> View Payment </a> </td>
                        <td> <a href="/payments/create" class="btn btn-primary"> Add Payment </a> </td>
                      </tr>
                  </table>

                </div> {{-- Closes card body --}}
            </div> {{-- Closes card --}}
        </div>
    </div>
</div>
@endsection
