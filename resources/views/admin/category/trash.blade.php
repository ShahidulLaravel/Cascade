@extends('layouts.dashboard')


@section('content')
<nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Trash</li>
  </ol>
</nav>

<div class="container">
    <div class="row">
        <div class="col-lg-11 m-auto">
        <div class="card mt-4">
            <div class="card-header">
                <img width="40" src="{{asset('Backend/fonts/001-trash-can.png')}}" alt="">
                <h3 class="d-inline float-right">Trash</h3>
            </div>
            @if ($trash_category->count() >= 1)
                <div class="card-body">
                    <form action="{{route('category.restore_all')}}" method="POST">
                    @csrf 
                        <table class="table table-striped">
                    <tr class="">
                        <th><input class="mr-2" type="checkbox" id="checkBoxOne"> Select All</th>
                        <th>SL</th>
                        <th>Category Name</th>
                        <th>Category Image</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($trash_category as $sl=> $category)
                        <tr>
                            <td>
                                <input type="checkbox" name="trash[]" class="category" id="checkBoxOne" value="{{$category->id}}">
                            </td>
                            <td>{{$sl + 1}}</td>
                            <td>{{$category->category_name}}</td>
                            <td>
                                <img width="100" src="{{asset('uploads/categories')}}/{{$category->category_image}}" alt="">
                            </td>
                            <td>
                                <a href="{{route('category.restore_single', $category->id)}}" class="text-dark btn btn-warning">Restore</a>

                                <a href="{{route('category.perDel_single', $category->id)}}" class="text-white btn btn-danger">Permanetly Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <button class="text-white btn btn-primary restore_btn d-none">Restore All</button>

                </div>
            @else
            <div class="mt-3 p-4 text-center">
                <h4 class="text-danger">Your Trash Is Empty !</h4>
                <img width="350" src="{{asset('Backend/images/gifs/02.gif')}}" alt="">
            </div>
            @endif
            
        </div>  
        </div>
    </div>
</div>

@endsection

@section('javascript')
<script>
    $("#checkBoxOne").on('click', function() {
        $('.restore_btn').toggleClass('d-none');
            this.checked ? $(".category").prop("checked", true) : $(".category").prop("checked", false);
            $('.delete_btn').toggleClass('d-none');
            this.checked ? $(".category").prop("checked", true) : $(".category").prop("checked", false);
    })

    $(".category").on('click', function() {
        $('.restore_btn').toggleClass('d-none');
        $('.delete_btn').toggleClass('d-none');
            
    })
</script>
@endsection