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
                    <form action="{{route('subcategory.update')}}" method="POST" enctype="multipart/form-data">
                     @csrf 
                     {{-- main input feild start here --}}
                    <div class="mb-3">
                        <label for="">Subcategory Name</label>
                        <input type="hidden" name="subcategory_id" value="{{$all_subcategory->id}}">
                         <input type="text" class="form-control" name="subcategory_name" value="{{$all_subcategory->subcategory_name}}">   
                    </div>
                    <div class="mb-3">
                        <label for="">Category</label>
                        <select name="category_id" class="form-control">
                        
                            @foreach ( $all_categories as $category)
                            <option value="{{$category->id}}" {{$all_subcategory->category_id == $category->id ? 'selected' : ''}}>{{$category->category_name}}
                            </option> 
                            @endforeach                         
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Subcategory Image</label>
                        <input type="file" class="form-control" name="subcategory_image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"> 
                        <div class="mt-3">
                        <img width="100" src="{{asset('uploads/subcategories')}}/{{$all_subcategory->subcategory_image}}" id="blah" alt="">
                    </div>   
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
