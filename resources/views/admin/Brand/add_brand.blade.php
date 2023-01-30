@extends('layouts.dashboard')


@section('content')

<div class="row">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <h3>Add Product Brand</h3>
            </div>
            <div class="card-body">
                <form action="{{route('brand.insert')}}" method="POST" enctype="multipart/form-data">
                @csrf
                 <div class="form-group mb-4">
                    <label for="example-email">Brand Name</label>
                    <input name="brand_name" type="text" id="example-email" name="example-email" class="form-control">
                </div>

                <div class="form-group mb-4">
                    <label for="example-img">Brand Logo</label>
                    <input name="brand_logo" type="file" id="example-img">
                </div>
                <button class="btn btn-primary" type="submit">Add Brand</button>

               </form>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <h3>Show Brands</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr class="text-center">
                        <th>SL</th>
                        <th>Brand Name</th>
                        <th>Brand Logo</th>
                    </tr>
                    @foreach ($brands as $key=> $brand)
                        <tr class="text-center">
                            <td>{{$key + 1}}</td>
                            <td>{{$brand->brand_name}}</td>
                            <td>
                                <img width="110" src="{{asset('uploads/products/brand')}}/{{$brand->brand_logo}}" alt="">
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

@endsection