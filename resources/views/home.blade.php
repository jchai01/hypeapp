@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="/students" class="btn btn-primary"> View Students </a>
                    <a href="/students/create" class="btn btn-primary"> Add Student </a> <br/><br/>
                    <a href="/attendance" class="btn btn-primary"> View Attendance </a>
                    <a href="/attendance/create" class="btn btn-primary"> Take Attendance </a> <br/><br/>
                    <a href="/payments" class="btn btn-primary"> View Payment </a>
                    <a href="/payments/create" class="btn btn-primary"> Add Payment </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
