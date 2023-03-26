@extends('frontend.master')


@section('content')

<div class="col-lg-10 m-auto">
    <div class="mt-5">
        <h2 class="text-center">Enter Your Order ID </h2>
    </div>
    <div class="mb-3 col-lg-8 m-auto">
        <form action="{{route('order.search')}}" method="POST">
            @csrf 
            <div class="mb-3">
                <label for="" class="form-label"></label>
                <input type="text" class="form-control" name="order_id" placeholder="Order ID">
                <div class="">
                    <button class="mt-2 btn btn-primary">Track My Order</button>
                </div>
            </div>
        </form>
    </div>
    <div>
       
    </div>
</div>

@endsection