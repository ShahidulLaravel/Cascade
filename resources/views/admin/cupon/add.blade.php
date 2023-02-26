@extends('layouts.dashboard')


@section('content')

<div class="row">
    
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <h3>Available Cupons</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Cupon Name</th>
                        <th>Type</th>
                        <th>Ammount</th>
                        <th>Expiry Date</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        @forelse ($cupons as $sl=> $cupon)
                            <tr>
                                <td>{{$sl + 1}}</td>
                                <td>{{$cupon->cupon_name}}</td>
                                <td>{{$cupon->type == 1 ? 'Percentage' : 'Fixed'}}</td>
                                <td>{{$cupon->amount}}</td>
                                <td>{{Carbon\Carbon::now()->diffIndays($cupon->expiry_date,false)}} Days to go</td>
                                <td>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td><p>No Cupon Addded Yet !!</p></td>
                            </tr>
                        @endforelse
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <h3>Add Product Cupon Here</h3>
            </div>
            <div class="card-body">
                 <form action="{{route('cupon.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="cupon_name">Cupon Name</label>
                        <input type="text" class="form-control" name="cupon_name">
                    </div>
                     <div class="mb-3">
                        <label for="type">Cupon Type</label>
                        <select name="type" class="form-control">
                            <option value="" selected>-- Select One --</option>
                            <option value="1">Percentage</option>
                            <option value="2">Fixed</option>
                        </select>
                    </div>
                     <div class="mb-3">
                        <label for="amount">Ammount</label>
                        <input type="number" name="amount" class="form-control" name="cupon_name">
                    </div>
                     <div class="mb-3">
                        <label for="date">Expiry Date</label>
                        <input type="date" class="form-control" name="expiry_date">
                    </div>


                    <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Add Cupon</button>
                    </div>
                </form>
            </div>
        </div>
       
    </div>
</div>

@endsection