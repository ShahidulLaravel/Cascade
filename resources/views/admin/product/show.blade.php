@extends('layouts.dashboard')


@section('content')

<div class="row">
    <div class="col-lg-12">
        @if (session('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div>
                {{session('success')}}
            </div>
            </div>
        @endif

        <table class="table table-striped">
            <tr>
                <th>Serial</th>
                <th>Product Name</th>
                <th>Category</th>
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
                    <td>{{$product->rel_to_cat->category_name}}</td>
                    <td>&#2547; {{$product->price}}</td>
                    <td>{{$product->discount == null ? '0' : $product->discount}}%</td>
                    <td>&#2547; {{$product->after_discount}}</td>
                    <td>
                        <img class="rounded" width="50" src="{{asset('uploads/Products/preview')}}/{{$product->preview}}" alt="">
                    </td>
                    <td class="mx-2-">  

                        <a href="{{route('edit.product', $product->id)}}" class="ml-2"><i class="fa-solid fa-pen-to-square"></i></a>

                        <a href="{{route('product.delete', $product->id)}}" class="btn text-danger"><i class="delete-btn fa-solid fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach 
        </table>
         {{$all_prodcuts->links()}}
    </div>
</div>

<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h2>Available Inventory</h2>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Product Name</th>
                            <th>Color Name</th>
                            <th>Size</th>
                            <th>Available Quantity</th>
                        </tr>
                        @foreach ($all_prodcuts_two as $product)
                            <tr>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->color_rel->color_name}}</td>
                                <td>{{$product->size_rel->size_name}}</td>
                                <td>{{$product->quantity}} Pcs </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
</div>

@endsection

