@extends('frontend.master')


@section('content')

<div class="row my-5">
    <div class="col-lg-6 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>Password Reset Request</h3>
            </div>
            <div class="card-body">
                <form action="{{route('password.request')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Enter your Registered Email</label>
                        <input type="text" name="email" class="form-control">
                    </div>

                    <div class="mb-3">
                       <button type="submit" class="btn btn-warning">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection