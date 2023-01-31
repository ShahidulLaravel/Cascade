@extends('layouts.dashboard')


@section('content')

<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered">
            <tr>
                <th>Serial</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Discount</th>
                <th>After Discount</th>
                <th>Preview</th>
                <th>Action</th>
            </tr>   
            @foreach ($all_prodcuts as $key=> $product)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$product->product_name}}</td>
                    <td>&#2547; {{$product->price}}</td>
                    <td>{{$product->discount == null ? '0' : $product->discount}}%</td>
                    <td>&#2547; {{$product->after_discount}}</td>
                    <td>
                        <img class="rounded" width="50" src="{{asset('uploads/Products/preview')}}/{{$product->preview}}" alt="">
                    </td>
                    <td>
                        <button class="btn btn-sm btn-success"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach 
        </table>
         {{$all_prodcuts->links()}}
    </div>
</div>


@endsection