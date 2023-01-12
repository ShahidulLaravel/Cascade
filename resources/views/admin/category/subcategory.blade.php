@extends('layouts.dashboard')


@section('content')

<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Subcategory</li>
  </ol>
</nav>

<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4>Show Subcategory</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Category</th>
                            <th>Subcategory Name</th>
                            <th>Subcategory Image</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($subcategories as $sl=> $subcategory )
                            <tr>
                                <td>{{$sl + 1}}</td>
                                <td>{{$subcategory->rel_to_category->category_name}}</td>
                                <td>{{$subcategory->subcategory_name}}</td>
                                <td>
                                    <img width="50" src="{{asset('uploads/subcategories')}}/{{$subcategory->subcategory_image}}" alt="">
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm">Delete</button>
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
                    <h4>Add Subcategory</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('subcategory.insert')}}" method="POST" enctype="multipart/form-data">
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
                        <label for="">Main Category</label>
                        <select name="category_id" class="form-control">
                            @foreach ( $categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option> 
                            @endforeach                         
                        </select>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Add Subcategory</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- extra javascript code --}}
@section('javascript')
@if (session('success'))
    <script>
            Swal.fire({
            position: 'center',
            icon: 'success',
            title: '{{session('success')}}',
            showConfirmButton: true,
            timer: 2500
            })
    </script>  
@endif
@endsection