@extends('layouts.dashboard')


@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4>Show Product Inventory</h4>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Product Name</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($inventories as $inventory )
                       <tr>
                            <td>{{$inventory->product_rel->product_name}}</td>
                            <td>{{$inventory->color_rel->color_name}}</td>
                            <td>{{$inventory->size_rel->size_name}}</td>
                            <td>{{$inventory->qtty}} Pcs</td>
                            <td><button class="btn btn-danger btn-sm"><i class="delete-btn fa-solid fa-trash"></i></button></td>
                        </tr> 
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4>Add Inventory</h4>
            </div>

            <div class="card-body">
                <form action="{{route('inventory.store')}}" method="POST">
                    @csrf 
                    <div class="mb-3">
                        <label for="" class="form-label">Product Name</label>
                        <input type="hidden" name="product_id" value="{{$product_info->id}}"/>

                        <input type="text" class="form-control"  readonly value="{{$product_info->product_name}}">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Select Color</label>
                        <select name="color_id" class="form-control">
                            <option value="">Color</option>
                            @foreach ($colors as $color)
                                <option value="{{$color->id}}">{{$color->color_name}}</option>
                            @endforeach
                        </select>
                    </div>
                   
                     <div class="mb-3">
                        <label for="" class="form-label">Select Size</label>
                        <select name="size_id" class="form-control">
                            <option value="">Size</option>
                            @foreach ($sizes as $size)
                                <option value="{{$size->id}}">{{$size->size_name ? $size->size_name : 'No Size'}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="qtty">
                    </div>
                    <div class="mb-3">
                       <button type="submit" class="btn btn-warning text-white">Add Product in Inventory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection