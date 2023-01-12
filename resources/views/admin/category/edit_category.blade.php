@extends('layouts.dashboard')


@section('content')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
        </ol>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Category</h4>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('category.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="example-email">Category Name</label>
                                <input type="hidden" name="update_id" value="{{$category_info->id}}">
                                <input name="category_name" type="text" id="example-email" name="example-email"
                                    class="form-control" value="{{$category_info->category_name}}">
                                @error('category_name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="example-img">Category Image</label>
                                <input name="category_image" type="file" id="example-img" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                @error('category_image')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            
                            <div class="mt-3 mb-3">
                                <img width="100" id="blah" src="{{asset('upload/category')}}/{{$category_info->category_image}}" alt="">
                            </div>

                            <button class="btn btn-primary" type="submit">Update Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
