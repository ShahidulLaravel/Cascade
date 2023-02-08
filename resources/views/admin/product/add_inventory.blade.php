@extends('layouts.dashboard');


@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4>Show Color Variation</h4>
                @if (session('success'))
                    <strong class="text-success">{{session('success')}}</strong>
                @endif
            </div>

            <div class="card-body">
                <table class="text-center table table-bordered">
                    <tr>
                        <th>Color Name</th>
                        <th>Color</th>
                        <th>Action</th>
                    </tr>
                    @forelse ($all_colors as $colors)
                        <tr>
                            <td>{{$colors->color_name}}</td>
                            <td><span class="badge" style="background: {{$colors->color_code}}; color:transparent" >primary</span></td>

                            <td><a href="{{route('delete', $colors->id)}}" class="btn btn-sm btn-primary"><i class="fa-solid fa-trash"></i></a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-danger text-center">No Colors Info Found</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>

        {{-- size --}}
        <div class="card mt-5">
            <div class="card-header">
                <h4>Show Size</h4>
                @if (session('success'))
                    <strong class="text-success">{{session('success')}}</strong>
                @endif
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Category</th>
                        <th>Size Name</th>
                        <th>Action</th>
                    </tr>
                    @forelse ($sizes as $size)
                        <tr>
                            <td>{{$size->category_id == null ? 'N/A' : $size->rel_to_cat->category_name }}</td>

                            <td>{{$size->size_name}}</td>

                            <td><a href="{{route('delete', $size->id)}}" class="btn btn-sm btn-primary"><i class="fa-solid fa-trash"></i></a></td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-danger text-center">No Size Info Found</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
        {{-- size --}}
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4>Add Color</h4>
            </div>

            <div class="card-body">
                <form action="{{route('product.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="color_name" class="form-label">Color Name</label>
                        <input type="text" class="form-control" name="color_name">
                    </div>

                    <div class="mb-3">
                        <label for="color_code" class="form-label">Color Code</label>
                        <input type="text" class="form-control" name="color_code">
                    </div>

                    <div class="mb-3">
                        <button name="btn" value="1"  type="submit" class="btn btn-primary">Add Color</button>
                    </div>
                </form>
            </div>
        </div>

        
         <div class="card mt-5">
            <div class="card-header">
                <h4>Add Size</h4>
            </div>

            <div class="card-body">
                <form action="{{route('product.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="size_name" class="form-label">Size Name</label>
                        <input type="text" class="form-control" name="size_name">
                    </div>
                    <div class="mb-3">
                        <label for="size_name" class="form-label">Category</label>
                        <select name="category_id" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <button name="btn" value="2" type="submit" class="btn btn-primary">Add Size</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
</div>

@endsection