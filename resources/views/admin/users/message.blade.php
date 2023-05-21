@extends('layouts.dashboard');


@section('content')

<div class="row">
     <div class="col-lg-12">
          <div class="card">
               <div class="card-header">
                    <h3>See Users Sending Messages Here</h3>
               </div>
               <div class="card-body">
                    <table class="table table-bordered">
                         <tr>
                              <th>SL</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Subject</th>
                              <th>Message</th>
                         </tr>
                         @forelse ($msg as $key => $message)
                              <tr>
                                   <td>{{$key + 1}}</td>
                                   <td>{{$message->name}}</td>
                                   <td>{{$message->email}}</td>
                                   <td>{{$message->subject}}</td>
                                   <td>{{$message->desp}}</td>
                              </tr>
                         @empty
                              <div class="alert alert-danger">
                                   <h3 class="text-center">No Messages Found</h3>
                              </div>
                         @endforelse
                    </table>
               </div>
          </div>
     </div>
</div>

@endsection
