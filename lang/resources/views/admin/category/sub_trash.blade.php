@extends('layouts.dashboard')

@section('content')

<div class="container">
    <div class="row">
        {{-- subcategory trash start --}}
            <div class="col-lg-11 m-auto">
            <div class="card mt-4">
                <div class="card-header">
                    <img width="40" src="{{asset('Backend/fonts/001-trash-can.png')}}" alt="">
                    <h3 class="d-inline float-right">Subcategory Trash</h3>
                </div>
                @if ($trash->count() >= 1)
                    <div class="card-body">
                        <form action="{{route('subcategory.restore_all')}}" method="POST">
                        @csrf 
                            <table class="table table-striped">
                        <tr class="">
                             <th><input class="mr-2" type="checkbox" id="checkBoxOne"> Select All</th>
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>Category Image</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($trash as $sl=> $category)
                            <tr>
                                <td>
                                    <input type="checkbox" name="trash[]" class="category" id="checkBoxOne" value="{{$category->id}}">
                                </td>
                                <td>{{$sl + 1}}</td>
                                <td>{{$category->subcategory_name}}</td>
                                <td>
                                    <img width="100" src="{{asset('uploads/subcategories')}}/{{$category->subcategory_image}}" alt="">
                                </td>
                                <td>
                                    <a href="{{route('subcategory.restore', $category->id)}}" class="text-dark btn btn-warning">Restore</a>

                                    <a href="{{route('subcategorysingel.delete',$category->id)}}" class="text-white btn btn-danger">Permanetly Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    <button class="btn btn-danger restore_btn d-none" type="submit">Restore All</button>
                    </form>
                    </div>
                @else
                <div class="mt-3 p-4 text-center">
                    <h4 class="text-danger">Your Trash Is Empty !</h4>
                    <img width="350" src="{{asset('Backend/images/gifs/02.gif')}}" alt="">
                </div>
                @endif
                
            </div>  
        </div>
        {{-- subcategory trash end --}}
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
