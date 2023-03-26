<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  </head>
  <body>
    <header class="clearfix">
      <h1>Cusomer Invoice</h1>
      <div id="company" class="">
        <div>Kumo E-Commerce</div>
        <div>12/a Dhanmondi<br /> </div>
        <div>+88-01631903731</div>
        <div><a href="mailto:company@example.com">kumo@developer.com</a></div>
      </div>
     
    </header>
    <main>

      <table class="table table-striped mt-5">
        <th>
          <tr>
            <th class="service">SL</th>
            <th class="desc">Products</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total
            </th>
          </tr>
        </th>
        <tbody>

        @foreach ( App\Models\OrderProduct::where('order_id', $order_id)->get() as $key=>$product )
                
          <tr>
            <td class="service">{{$key + 1}}</td>
            <td class="desc">{{$product->rel_with_product->product_name}}</td>
            <td class="unit">{{$product->price}}</td>
            <td class="qty">{{$product->quantity}}</td>
            <td class="total">{{$product->price * $product->quantity}}</td>
          </tr>
          @endforeach
          <br>
          <hr>

          <tr class="">
            <td colspan="4">Subtotal</td>
            <td class="total">TK {{App\Models\Order::where('order_id', $order_id)->first()->sub_total}}</td>
          </tr>
          <tr>
            <td colspan="4" class="">Discount</td>
            <td class="grand total"> TK {{App\Models\Order::where('order_id', $order_id)->first()->discount}}</td>
          </tr>
          <tr>
            <td colspan="4">Delivery Charge</td>
            <td class="total"> TK{{App\Models\Order::where('order_id', $order_id)->first()->charge}}</td>
          </tr>
          <tr>
            <td colspan="4" class="grand total">Grand Total</td>
            <td class="grand total"> <strong>TK {{App\Models\Order::where('order_id', $order_id)->first()->sub_total + App\Models\Order::where('order_id', $order_id)->first()->charge - App\Models\Order::where('order_id', $order_id)->first()->discount}}</strong></td>
          </tr>
        </tbody>
      </table>
      
      <div id="notices mt-4">
         <table width="220" border="0" cellpadding="0" cellspacing="0" align="left" class="col">

            <tbody>
                <tr>
                <td style="">
                    <strong>BILLING INFORMATION</strong>
                </td>
                </tr>
                <tr>
                <td width="100%" height="10"></td>
                </tr>
                <tr>
                <td style="">
                    {{App\Models\BillingDetails::where('order_id', $order_id)->first()->name}}<br> 
                    @php
                    $bill_address = App\Models\BillingDetails::where('order_id', $order_id)->first()->address
                    @endphp
                    {{$bill_address == '' ? 'Billing Address Same as Shipping Address' : $bill_address}}<br> 
                    {{App\Models\BillingDetails::where('order_id', $order_id)->first()->billing_mobile}}
                </td>
                </tr>
            </tbody>
            </table>

            <table width="220" border="0" cellpadding="0" cellspacing="0" align="left" class="col">
            <tbody>
                <tr class="visibleMobile">
                <td height="20"></td>
                </tr>
                <tr>
                <td style="">
                    <strong>PAYMENT METHOD</strong>
                </td>
                </tr>
                <tr>
                <td width="100%" height="10"></td>
                </tr>
                <tr>
                <td style="">
                    @php
                    $payment_method = App\Models\Order::where('order_id', $order_id)->first()->payment_method;
                    @endphp
                    @if ($payment_method == 1)
                    COD - Cash on Delivery
                    @elseif ($payment_method == 2)
                    SSL Commerz Pay
                    @else
                    Stripe Payment 
                    @endif
                    <br>Transaction ID : <span style="color: #ff0000;">
                    @if ($payment_method == 1)
                    Not Appliable for COD Method
                    @elseif ($payment_method == 2)
                      {{App\Models\Sslorder::where('customer_id', Auth::guard('customerlogin')->id())->first()->transaction_id}}
                    @else
                    {{App\Models\Order::where('order_id', $order_id)->first()->tran_id}}
                    @endif</span><br>
                    <a href="#" style="color:#b0b0b0;">Right of Withdrawal</a>
                </td>
                </tr>
            </tbody>
            </table>

            <table width="220" border="0" cellpadding="0" cellspacing="0" align="left" class="col">
            <tbody>
                <tr class="hiddenMobile">
                <td height="35"></td>
                </tr>
                <tr class="visibleMobile">
                <td height="20"></td>
                </tr>
                <tr>
                <td style="margin-top:-20px;">
                    <strong>SHIPPING INFORMATION</strong>
                </td>
                </tr>
                <tr>
                <td width="100%" height="10"></td>
                </tr>
                <tr>
                <td style="">
                    @php
                    $city_id = App\Models\ShippingDetails::where('order_id', $order_id)->first()->city_id
                    @endphp
                    @php
                    $country_id = App\Models\ShippingDetails::where('order_id', $order_id)->first()->country_id
                    @endphp

                    {{App\Models\ShippingDetails::where('order_id', $order_id)->first()->name}}<br>

                    {{App\Models\City::where('id', $city_id)->first()->name}}<br> {{App\Models\ShippingDetails::where('order_id', $order_id)->first()->zip_code}},
                    {{App\Models\Country::where('id', $country_id)->first()->name}}<br> Mobile No: {{App\Models\ShippingDetails::where('order_id', $order_id)->first()->shipping_mobile}}
                </td>
                </tr>
            </tbody>
            </table>
            {{-- main table end here --}}

      </div>
      
    <footer class="mt-5 float-right">
     Thank you for Shopping with Us. Have a nice day.
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>