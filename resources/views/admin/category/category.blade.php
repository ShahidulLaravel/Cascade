@extends('layouts.dashboard')


@section('content')

<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Category</li>
  </ol>
</nav>

<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h2>Show Category List</h2>
                    @if (session('cat_success'))
                        <strong class="text-success">{{session('cat_success')}}</strong>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <tr>
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>Category Image</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($show_category as $key=> $category )
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$category->category_name}}</td>
                                <td>
                                    <img width="50" src="{{asset('uploads/categories/'. $category->category_image)}}" alt="">
                                </td>
                                <td>
                                   <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Steps
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Edit</a>
                                        <a class="dropdown-item" href="{{route('category.delete',$category->id)}}">Delete</a>

                                    </div>
                                    </div> 
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Add Product Category</h4>
                    @if (session('success'))
                        <strong class="text-success">{{session('success')}}</strong>
                    @endif
                </div>
            
                <div class="card-body">
                
               <form action="{{route('category.sort')}}" method="POST" enctype="multipart/form-data">
                @csrf
                 <div class="form-group mb-4">
                    <label for="example-email">Category Name</label>
                    <input name="category_name" type="text" id="example-email" name="example-email" class="form-control">
                    @error('category_name')
                        <strong class="text-danger">{{$message}}</strong>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="example-img">Category Image</label>
                    <input name="category_image" type="file" id="example-img">
                    @error('category_image')
                        <strong class="text-danger">{{$message}}</strong>
                    @enderror
                </div>
                <button class="btn btn-primary" type="submit">Add Category</button>

               </form>
             
            </div>
            </div>
            </div>
        </div>
    </div>
</div>


@endsection