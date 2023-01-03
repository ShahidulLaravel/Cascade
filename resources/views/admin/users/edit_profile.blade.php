@extends('layouts.dashboard')


@section('content')

<div class="container">
    <div class="row">
        {{-- edit general info --}}
        <div class="col-lg-12">
            <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="row mt-5 align-items-center">
                <div class="col-md-3 text-center mb-5">
                  <div class="avatar avatar-xl">
                    <img src="{{asset('Admin/avatars/face-1.jpg')}}" alt="..." class="avatar-img rounded-circle">
                  </div>
                </div>

                <div class="col">
                  <div class="row align-items-center">
                    <div class="col-md-7">
                      <h4 class="mb-1">{{Auth::user()->name}}</h4>
                      <h6 class="text-muted mb-1 card-title">{{Auth::user()->email}}</h6>
                      <p class="small mb-3"><span class="badge badge-dark">Web Developer</span></p>
                    </div>
                  </div>
                  <div class="row mb-4">
                    <div class="col-md-7">
                      <p class="text-muted"> This is {{Auth::user()->name}}. And it's your Dashboard for further Update </p>
                    </div>
                  </div>
                </div>
              </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Update Information</h4>
                   @if (session('success'))
                       <strong class="text-success">{{session('success')}}</strong>
                   @endif
                </div>
                <div class="card-body">
                    <form action="{{route('update.info')}}" method="POST">
                     @csrf   
                      <div class="form-group mb-3">
                        <label for="example-name">Name</label>
                        <input type="text" id="example-name" name="name" class="form-control" value="{{Auth::user()->name}}">
                      </div>

                      <div class="form-group mb-3">
                        <label for="example-email">Email</label>
                        <input name="email" type="email" id="example-email" class="form-control" value="{{Auth::user()->email}}">
                      </div>

                      <button class="btn btn-primary" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- update password --}}
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Update Password</h4>
                    @if (session('pass_success'))
                        <strong class="text-success">{{session('pass_success')}}</strong>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{route('update.password')}}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                        <label for="example-name">Current Password</label>
                        <input type="password" name="old_password" class="form-control" placeholder="Current Password">
                        @error('old_password')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror

                        @if(session('old_password'))
                            <strong class="text-warning">{{session('old_password')}}</strong>
                        @endif
                      </div>

                      <div class="form-group mb-3">
                        <label for="example-name">New Password</label>
                        <input type="password"  name="password" class="form-control" placeholder="New Password">
                         @error('password')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                      </div>

                      <div class="form-group mb-3">
                        <label for="example-name">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm New Password">
                         @error('password_confirmation')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                      </div>
                      <button class="btn btn-primary" type="submit">Update Password</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- upload image --}}
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Upload Profile Photo</h4>
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                        <label for="example-name">Upload Profile Picture</label>

                        <input type="file" id="image" name="photo">
                      </div>
                      <button class="btn btn-primary" type="submit">Upload Profile</button>
                    </form>
                </div>
            </div>
        </div>
        {{-- row and container ending div --}}
    </div>
</div>

@endsection