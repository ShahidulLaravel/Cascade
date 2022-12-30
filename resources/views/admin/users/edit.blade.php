@extends('layouts.dashboard')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-10 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>User Edit</h3>
                </div>
               
                <div class="card-body">
                    <div class="card-body">

                <form method="POST" action="{{route('user.update', $user->id)}}">
                @csrf 
                @method('PUT')
                <div class="mb-3">
                  <input value="{{$user->name}}" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" aria-label="Name" aria-describedby="email-addon">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                </div>

                <div class="mb-3">
                  <input value="{{$user->email}}" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-success w-100 my-4 mb-2">Update</button>
                </div>
              </form>
            </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection