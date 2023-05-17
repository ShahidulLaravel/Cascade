@extends('frontend.master')


@section('content')

<div class="row my-5">
    <div class="col-lg-6 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>Password Reset</h3>
            </div>
            
            <div class="card-body">
                {{-- @if(session('error'))
                    <div class="alert alert-danger">
                        <strong>{{session('error')}}</strong>
                    </div>
                @endif --}}
                @if(session('success'))
                    <div class="alert alert-success">
                        <strong>{{session('success')}}</strong>
                    </div>
                @endif
                <form action="{{route('password.set')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
                        <input type="hidden" value="{{$token}}" name="token" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <div class="mb-3">
                       <button type="submit" class="btn btn-primary">Set New Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection