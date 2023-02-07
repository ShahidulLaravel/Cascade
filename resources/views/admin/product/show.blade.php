@extends('layouts.dashboard')


@section('content')

<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered">
            <tr>
                <th>Serial</th>
                <th>Product Name</th>
                <th>Brand</th>
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
                    <td>{{$product->rel_to_brand->brand_name}}</td>
                    <td>{{$product->rel_to_cat->category_name}}</td>
                    <td>&#2547; {{$product->price}}</td>
                    <td>{{$product->discount == null ? '0' : $product->discount}}%</td>
                    <td>&#2547; {{$product->after_discount}}</td>
                    <td>
                        <img class="rounded" width="50" src="{{asset('uploads/Products/preview')}}/{{$product->preview}}" alt="">
                    </td>
                    <td class="mx-2-">  
                        <a href="{{route('product.inventory', $product->id)}}" class="text-warning"><i class="fa-solid fa-store"></i></a>

                        <a href="{{route('edit.product', $product->id)}}" class="ml-2"><i class="fa-solid fa-pen-to-square"></i></a>

                        <button class="btn text-danger"><i class="delete-btn fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach 
        </table>
         {{$all_prodcuts->links()}}
    </div>
</div>



@endsection

