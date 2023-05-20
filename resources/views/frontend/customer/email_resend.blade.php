@extends('frontend.master')


@section('content')

<div class="row my-5">
    <div class="col-lg-6 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>Resend Verification Email</h3>
            </div>
            
            <div class="card-body">
                @if(session('error'))
                    <div class="alert alert-danger">
                        <strong>{{session('error')}}</strong>
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-warning">
                        <strong>{{session('success')}}</strong>
                    </div>
                @endif
                @if(session('success_three'))
					<div class="alert alert-warning">
					<strong>{{session('success_three')}}</strong>
					</div>
				@endif
                 @if(session('warn'))
                    <div class="alert alert-warning">
                        <strong>{{session('warn')}}</strong>
                    </div>
                @endif

                <form action="{{route('email.resend.request')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Enter your Registered Email</label>
                        <input type="text" name="email" class="form-control">
                    </div>

                    <div class="mb-3">
                       <button type="submit" class="btn btn-warning">Resend</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection