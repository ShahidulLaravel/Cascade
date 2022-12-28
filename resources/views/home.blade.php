@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-3">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>You Are Successfully Loggin <span class="text-primary">{{Auth::user()->name}}</span></h3>
                    <span>This is Your Dashboard</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
