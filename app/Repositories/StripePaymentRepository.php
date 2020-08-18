<?php

namespace App\Repositories;

use App\Payment;
use App\Pricing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Stripe\BalanceTransaction;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class StripePaymentRepository implements PaymentInterface
{
    public function __construct()
    {
        Stripe::setApiKey(config('stripe.secret'));
    }

    /**
     * @param array $request
     * @return StripeSession
     * @throws ApiErrorException
     */
    public function initiatePayment(array $request)
    {
        $packageDetails = Pricing::findorFail($request['package_id']);
        $data = StripeSession::create([
            'payment_method_types' => [
                'card'
            ],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'bdt',
                    'product_data' => [
                        'name' => $packageDetails->package_name,
                    ],
                    'unit_amount' => $packageDetails->price * 100, //Stripe calculates amount in cents or poysa
                ],
                'quantity' => 1,
            ]],
            'locale' => 'auto',
            'mode' => 'payment',
            'success_url' => config('app.url') . '/success/session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => config('app.url') . '/cancel/session_id={CHECKOUT_SESSION_ID}',
        ]);
        Payment::create([
            'user_id' => Auth::user()->id,
            'package_id' => $packageDetails->id,
            'package_name' => $packageDetails->package_name,
            'premium_jobs' => $packageDetails->premium_job,
            'email' => Auth::user()->email,
            'amount' => ($data->amount_total / 100),
            'status' => 'Pending',
            'session_id' => $data->id,
            'payment_option' => 'Stripe',
            'currency' => $data->currency,
        ]);
        return $data;

        // No exception handling performed as the error will be shown by Stripe in their hosted page

    }

    /**
     * @param $session_id
     * @throws ApiErrorException
     */
    public function paymentSucceed($session_id)
    {
        //Stripe::setApiKey(config('stripe.secret'));
        $session = StripeSession::retrieve($session_id);
        $payment_details = PaymentIntent::retrieve(
            $session->payment_intent,
            []
        );

        $status = $payment_details->status;
        //Stripe calculates amount in cents or poysa
        $net_amount = $payment_details->amount / 100;
        $payment_method_types = $payment_details->payment_method_types[0];

        $transaction = BalanceTransaction::retrieve(
            $payment_details->charges->data[0]['balance_transaction'],
            []
        );
        Payment::where('session_id', $session_id)
            ->update([
                'status' => $status,
                'payment_method' => $payment_method_types,
                'transaction_id' => $transaction->id,
            ]);

        // $accountBalance = Auth::user()->premium_jobs_balance;
        // $newbalance = (($session->amount_total / 100) + $accountBalance);
        // $updateBalance = User::findorFail(Auth::user()->id)->update(['premium_jobs_balance' => $newbalance]);
        Session::flash('msg', ['status' => 'success', 'data' => 'Payment Successful . Balance Added']);
        return;
    }

    /**
     * @param $id
     */
    public function paymentCancelled($id)
    {
        Payment::where('session_id', $id)
            ->update(array(
                'status' => 'CANCELLED',
            ));
        return Session::flash('msg', ['status' => 'danger', 'data' => 'Payment Cancelled.']);
    }
}
