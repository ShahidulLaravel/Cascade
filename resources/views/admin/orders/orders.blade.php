@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-lg-10 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>Order Details</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Order ID</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($myorder as $order)
                        <tr>
                            <td>{{$order->order_id}}</td>
                            <td>&#2547;{{$order->grand_total}}</td>
                            <td>{{$order->created_at->diffForHumans()}}</td>
                            <td>
                                @if ($order->payment_method == 1)
                                    <div class="badge badge-primary p-1">Cash On Delivery</div>
                                @elseif ($order->payment_method == 2)
                                    <div class="badge badge-danger p-1">SSL Commerz</div>
                                @else
                                    <div class="badge badge-success p-1">Stripe</div>
                                @endif

                            </td>
                            <td>
                                @php
                                    if($order->status == 0){
                                       echo '<span class="badge badge-primary p-1">Oreder Placed</span>' ;
                                    }elseif ($order->status == 1) {
                                        echo '<span class="badge badge-primary p-1">On Processing</span>';
                                    }
                                    elseif ($order->status == 2) {
                                        echo '<span class="badge badge-primary p-1">Picked Up</span>';
                                    }
                                    elseif ($order->status == 3) {
                                        echo '<span class="badge badge-primary p-1">Ready For Deleivered</span>';
                                    }
                                    elseif ($order->status == 4) {
                                        echo '<span class="badge badge-primary p-1">Delivered</span>';
                                    }else {
                                        echo '<span class="badge badge-primary p-1">No Records !!</span>';
                                    }
                                @endphp
                            </td>
                            <td>

                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Order Status
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">Placed</a></li>
                                        <li><a class="dropdown-item" href="#">Processing</a></li>
                                        <li><a class="dropdown-item" href="#">Pick Up the Product</a></li>
                                        <li><a class="dropdown-item" href="#">Ready to Delivered</a></li><li><a class="dropdown-item" href="#">Delivered</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    
</div>

@endsection