@extends('layouts.dashboard');


@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4>Show Color Variation</h4>
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
                            <td><button class="btn btn-sm btn-danger">Delete</button></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-danger text-center">No Colors Info Found</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
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
                        <button type="submit" class="btn btn-primary">Add Color</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection