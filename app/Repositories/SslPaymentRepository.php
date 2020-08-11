<?php

namespace App\Repositories;

use App\Orders;
use App\Pricing;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\PaymentInterface;
use Illuminate\Support\Facades\Session;
use App\Library\SslCommerz\SslCommerzNotification;

class SslPaymentRepository implements PaymentInterface
{
    public function initiatePayment(array $request)
    {
        Session::put('previous-url', url()->previous());
        $packageDetails = Pricing::findorFail($request['package_id']);

        $post_data = array();
        $post_data['total_amount'] = $packageDetails->price; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = ' ';
        $post_data['cus_email'] = Auth::user()->email;
        $post_data['cus_add1'] = ' ';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = " ";
        $post_data['cus_phone'] = ' ';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = " ";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = " ";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = $packageDetails->package_name;
        $post_data['product_category'] = "Package";
        $post_data['product_profile'] = " ";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    public function postPaymentSucceed(array $request)
    {

        $tran_id = $request['tran_id'];
        $amount = $request['amount'];
        $currency = $request['currency'];

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($tran_id, $amount, $currency, $request);

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Complete']);
                return Session::flash('msg', [
                    'status' => 'success',
                    'data' => 'Transaction Successfull. Balance Added.'
                ]);
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);
                return Session::flash('msg', [
                    'status' => 'danger',
                    'data' => 'Transaction Failed.'
                ]);
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Complete']);
            return Session::flash('msg', [
                'status' => 'success',
                'data' => 'Transaction Successfull. Balance Added.'
            ]);
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            return Session::flash('msg', [
                'status' => 'danger',
                'data' => 'Transaction Failed'
            ]);
        }
    }
    public function getPaymentSucceed($args)
    {
        return null;
    }

    public function paymentCancelled()
    {
        Session::flash('msg', ['status' => 'danger', 'data' => 'Payment Cancelled.']);
        $url = Session::get('previous-url');
        return ($url);
    }
}
