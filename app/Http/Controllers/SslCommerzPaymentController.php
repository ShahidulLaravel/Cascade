<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\City;
use App\Models\Logo;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sslorder;
use Illuminate\Support\Str;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\CustomerLogin;
use App\Models\BillingDetails;
use App\Models\ShippingDetail;
use Illuminate\Support\Carbon;
use App\Mail\CustomerInvoiceMail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Library\SslCommerz\SslCommerzNotification;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        // print_r(session('data'));
        // die();
        $data = session('data');
        $amount = $data['sub_total'] + $data['charge'] - $data['discount'];
        $post_data = array();
        $post_data['total_amount'] = $amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $data = session('data');
        $amount = $data['sub_total'] + $data['charge'] - $data['discount'];
        $customer_id = $data['customer_id'];
        $update_product = DB::table('sslorders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => CustomerLogin::find($customer_id)->name,
                'email' => Auth::guard('customerlogin')->user()->email,
                'phone' => $data['billing_mobile'],
                'amount' => $amount,
                'status' => 'Pending',
                'address' => CustomerLogin::find($customer_id)->address,
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency'],
                'shipping_name' => $data['name'],
                'shipping_email' => $data['email'],
                'shipping_phone' => $data['shipping_mobile'],
                'country_id' => $data['country_id'],
                'city_id' => $data['city_id'],
                'shipping_address' => $data['address'],
                'zip_code' => $data['zip_code'],
                'notes' => $data['notes'],
                'company' => $data['company'],
                'sub_total' => $data['sub_total'],
                'discount' => $data['discount'],
                'customer_id' => $data['customer_id'],
                'charge' => $data['charge'],
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    // public function payViaAjax(Request $request)
    // {

    //     $post_data = array();
    //     $post_data['total_amount'] = '10'; # You cant not pay less than 10
    //     $post_data['currency'] = "BDT";
    //     $post_data['tran_id'] = uniqid(); // tran_id must be unique

    //     # CUSTOMER INFORMATION
    //     $post_data['cus_name'] = 'Customer Name';
    //     $post_data['cus_email'] = 'customer@mail.com';
    //     $post_data['cus_add1'] = 'Customer Address';
    //     $post_data['cus_add2'] = "";
    //     $post_data['cus_city'] = "";
    //     $post_data['cus_state'] = "";
    //     $post_data['cus_postcode'] = "";
    //     $post_data['cus_country'] = "Bangladesh";
    //     $post_data['cus_phone'] = '8801XXXXXXXXX';
    //     $post_data['cus_fax'] = "";

    //     # SHIPMENT INFORMATION
    //     $post_data['ship_name'] = "Store Test";
    //     $post_data['ship_add1'] = "Dhaka";
    //     $post_data['ship_add2'] = "Dhaka";
    //     $post_data['ship_city'] = "Dhaka";
    //     $post_data['ship_state'] = "Dhaka";
    //     $post_data['ship_postcode'] = "1000";
    //     $post_data['ship_phone'] = "";
    //     $post_data['ship_country'] = "Bangladesh";

    //     $post_data['shipping_method'] = "NO";
    //     $post_data['product_name'] = "Computer";
    //     $post_data['product_category'] = "Goods";
    //     $post_data['product_profile'] = "physical-goods";

    //     # OPTIONAL PARAMETERS
    //     $post_data['value_a'] = "ref001";
    //     $post_data['value_b'] = "ref002";
    //     $post_data['value_c'] = "ref003";
    //     $post_data['value_d'] = "ref004";


    //     #Before  going to initiate the payment order status need to update as Pending.
    //     $update_product = DB::table('sslorders')
    //         ->where('transaction_id', $post_data['tran_id'])
    //         ->updateOrInsert([
    //             'name' => $post_data['cus_name'],
    //             'email' => $post_data['cus_email'],
    //             'phone' => $post_data['cus_phone'],
    //             'amount' => $post_data['total_amount'],
    //             'status' => 'Pending',
    //             'address' => $post_data['cus_add1'],
    //             'transaction_id' => $post_data['tran_id'],
    //             'currency' => $post_data['currency']
    //         ]);

    //     $sslc = new SslCommerzNotification();
    //     # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
    //     $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

    //     if (!is_array($payment_options)) {
    //         print_r($payment_options);
    //         $payment_options = array();
    //     }

    // }

    public function success(Request $request)
    {

        $tran_id = $request->input('tran_id');
        $data = Sslorder::where('transaction_id', $tran_id)->get();
        $city = City::find($data->first()->city_id);
        $order_id = Str::upper(substr($city->name, '0', '3')) . '-' . rand(10, 100000);

        $logo = Logo::all();
        //ssl insert 4 table 
        Order::insert([
            'order_id' => $order_id,
            'customer_id' => $data->first()->customer_id,
            'sub_total' => $data->first()->sub_total,
            'grand_total' => $data->first()->amount,
            'discount' => $data->first()->discount,
            'charge' => $data->first()->charge,
            'payment_method' => 2,
            'created_at' => Carbon::now(),
        ]);
        BillingDetails::insert([
            'order_id' => $order_id,
            'customer_id' => $data->first()->customer_id,
            'name' => $data->first->customer_id->name,
            'email' => $data->first->customer_id->email,
            'billing_mobile' => $data->first()->phone,
            'company' => $data->first()->company,
            'address' => $data->first->customer_id->address,
            'created_at' => Carbon::now(),
        ]);
        ShippingDetail::insert([
            'order_id' => $order_id,
            'name' => $data->first()->shipping_name,
            'email' => $data->first()->shipping_email,
            'shipping_mobile' => $data->first()->shipping_phone,
            'address' => $data->first()->address,
            'zip_code' => $data->first()->zip_code,
            'notes' => $data->first()->notes,
            'country_id' => $data->first()->country_id,
            'city_id' => $data->first()->city_id,
        ]);
        //   return back()->with('success','Congratulations ! Your Order Have been Placed'); 

        $carts = Cart::where('customer_id',$data->first()->customer_id)->get();

        foreach ($carts as $cart) {
            OrderProduct::insert([
                'order_id' => $order_id,
                'customer_id' => $data->first()->customer_id,
                'product_id' => $cart->product_id,
                'color_id' => $cart->color_id,
                'size_id' => $cart->size_id,
                'quantity' => $cart->quantity,
                'price' => $cart->rel_with_product->after_discount,
                'created_at' => Carbon::now(),
            ]);

            Product::where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->where('id', $cart->product_id)->decrement('quantity', $cart->quantity);

            Cart::find($cart->id)->delete(); 
        }

        //sendinng customer invoice email here
        $mail = $data->first->customer_id->email;
        Mail::to($mail)->send(new CustomerInvoiceMail($order_id, $logo));

        //sending sms to our users
        // $total = $request->sub_total + $request->charge - ($request->discount);
        // $url = "http://bulksmsbd.net/api/smsapi";
        // $api_key = "JO77QbIYxV0lAO0zbPDh";
        // $senderid = "8809617611026";
        // $number = $request->billing_mobile;
        // $message = "Congratulations Your order has been Placed.Thank you for shopping With us. Please ready Tk ".$total;

        // $data = [
        //      "api_key" => $api_key,
        //      "senderid" => $senderid,
        //      "number" => $number,
        //      "message" => $message
        // ];
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // $response = curl_exec($ch);
        // curl_close($ch);

        return redirect()->route('order.success', $order_id)->withSuccess('Your Order Is Placed !!');
        

    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('sslorders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('sslorders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('sslorders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('sslorders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('sslorders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('sslorders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}
