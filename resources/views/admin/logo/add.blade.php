@extends('layouts.dashboard')


@section('content')

<div class="row">
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>Add Logo</h3>
            </div>
            <div class="card-body">
                 <form action="{{route('logo.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="cupon_name">Select Logo</label>
                        <input type="file" class="form-control" name="logo">
                    </div>
                     
                    <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Add Logo</button>
                    </div>
                </form>
            </div>
        </div>
       
    </div>
</div>

@endsection