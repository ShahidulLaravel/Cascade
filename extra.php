        // $amount = $request->input('amount');
        // $currency = $request->input('currency');

        // $sslc = new SslCommerzNotification();

        // #Check order status in order tabel against the transaction id or order id.
        // $order_details = DB::table('sslorders')
        // ->where('transaction_id', $tran_id)
        // ->select('transaction_id', 'status', 'currency', 'amount')->first();

        // if ($order_details->status == 'Pending') {
        // $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

        // if ($validation) {
        // /*
        // That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
        // in order table as Processing or Complete.
        // Here you can also sent sms or email for successfull transaction to customer
        // */
        // $update_product = DB::table('sslorders')
        // ->where('transaction_id', $tran_id)
        // ->update(['status' => 'Processing']);

        // echo "<br>Transaction is successfully Completed";
        // }
        // } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
        // /*
        // That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
        // */
        // echo "Transaction is successfully Completed";
        // } else {
        // #That means something wrong happened. You can redirect customer to your product page.
        // echo "Invalid Transaction";
        // }