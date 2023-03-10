@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-11 m-auto">
            <div class="card">
                <div class="card-header">
                    <h2>User List</h2>
                    
                </div>
                 @if(session('success'))
                        <strong class="m-3 alert alert-success">{{session('success')}}</strong>
                    @endif
                <div class="card-body">
              
                    <table class="table table-striped">
                        <tr>
                            <th>SL</th>
                            <th>Profile Photo</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Crateat At</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($users as $sl=> $user)
                        <tr>
                            <td>{{$sl+1}}</td>
                            <td>
                                @if($user->photo == null)
                                    <img style="width:50px; height:50px;" src="{{ Avatar::create($user->name)->toBase64()}}" />
                                @else
                                    <img style="width:50px; height:50px;" src="{{asset('uploads/users/')}}/{{$user->photo}}" alt="" class="avatar-img rounded-circle">
                                @endif
                            </td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->created_at->diffForHumans()}}</td>
                            <td>
                                <a href="{{route('user.delete', $user->id)}}" type="submit" class="btn btn-sm btn-primary">Delete</a>                         
                            </td>
                        </tr>
                        @endforeach
                    </table>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection