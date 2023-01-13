@extends('layouts.dashboard')


@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-11 m-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Subcategory</h4>
                </div>
                  <div class="card-body">
                    <form action="#" method="POST" enctype="multipart/form-data">
                     @csrf 
                     {{-- main input feild start here --}}
                    <div class="mb-3">
                        <label for="">Subcategory Name</label>
                         <input type="text" class="form-control" name="subcategory_name">   
                    </div>
                    <div class="mb-3">
                        <label for="">Subcategory Image</label>
                        <input type="file" class="form-control" name="subcategory_image">    
                    </div>
                    
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Update Subcategory</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection