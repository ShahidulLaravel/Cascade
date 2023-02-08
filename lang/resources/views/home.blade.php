@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-3">
                <div class="card-header">Dashboard</div>
                
            <div class="col-lg-12">
            <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
                
              <div class="row mt-5 align-items-center">
                <div class="col-md-3 text-center mb-5">
                     
                  <div class="avatar avatar-xl">

                    @if(Auth::user()->photo == null)
                      <img src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" />
                    @else
                      <img style="width: 140px; height:140px;" src="{{asset('uploads/users/')}}/{{Auth::user()->photo}}" alt="..." class="avatar-img rounded-circle">
                    @endif

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
                      <p class=""> This is {{Auth::user()->name}} With  My Dashboard  </p>
                    </div>
                  </div>
                </div>
              </div>
        </div>
                <div class="card-body">
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                     <h3>Welcome Back ! <span class="text-primary">{{Auth::user()->name}}</span></h3>
                    <span>This is Your Dashboard</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
