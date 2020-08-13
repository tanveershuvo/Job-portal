<?php

namespace App\Repositories;

use App\User;
use App\Payment;
use App\Pricing;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Stripe\BalanceTransaction;
use Stripe\Exception\CardException;
use Illuminate\Support\Facades\Auth;
use App\Repositories\PaymentInterface;
use Illuminate\Support\Facades\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Exception\RateLimitException;
use Stripe\Exception\ApiConnectionException;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Exception\AuthenticationException;
use Stripe\Exception\InvalidRequestException;

class StripePaymentRepository implements PaymentInterface
{
    public function __construct()
    {
        Stripe::setApiKey(config('stripe.secret'));
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function initiatePayment(array $request)
    {
        $packageDetails = Pricing::findorFail($request['package_id']);
        try {

            $session = StripeSession::create([
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
                'client_reference_id' => Auth::user()->id,
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
                'amount' => ($session->amount_total / 100),
                'status' => 'Pending',
                'session_id' => $session->id,
                'payment_option' => 'Stripe',
                'currency' => $session->currency,
            ]);

            return $session;
        } catch (CardException $e) {
            return Session::flash('msg', [
                'status' => 'danger',
                'data' => '
            Status is:' . $e->getHttpStatus() . '\n
            Type is:' . $e->getError()->type . '\n
            Code is:' . $e->getError()->code . '\n
            Param is:' . $e->getError()->param . '\n
            Message is:' . $e->getError()->message . ''
            ]);
        } catch (RateLimitException $e) {
            return Session::flash('msg', [
                'status' => 'danger',
                'data' => 'Too many requests made to the API too quickly'
            ]);
        } catch (InvalidRequestException $e) {
            return Session::flash('msg', [
                'status' => 'danger',
                'data' => 'Invalid parameters were supplied to Stripe\'s API'
            ]);
        } catch (AuthenticationException $e) {
            return Session::flash('msg', [
                'status' => 'danger',
                'data' => 'Authentication with Stripe\'s API failed'
            ]);
        } catch (ApiConnectionException $e) {
            return Session::flash('msg', [
                'status' => 'danger',
                'data' => 'Network communication with Stripe failed'
            ]);
        } catch (ApiErrorException $e) {
            return Session::flash('msg', [
                'status' => 'danger',
                'data' => $e
            ]);
        } catch (Exception $e) {
            return Session::flash('msg', [
                'status' => 'danger',
                'data' => $e
            ]);
        }
    }
    /**
     * After successful payment
     *
     * @param var $session_id
     * @return successpage
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
                'status' =>  $status,
                'payment_method' => $payment_method_types,
                'transaction_id' => $transaction->id,
            ]);

        // $accountBalance = Auth::user()->premium_jobs_balance;
        // $newbalance = (($session->amount_total / 100) + $accountBalance);
        // $updateBalance = User::findorFail(Auth::user()->id)->update(['premium_jobs_balance' => $newbalance]);
        Session::flash('msg', ['status' => 'success', 'data' => 'Payment Successful . Balance Added']);
        return;
    }

    public function paymentCancelled($id)
    {
        Payment::where('session_id', $id)
            ->update([
                'status' => 'CANCELLED',
            ]);
        return Session::flash('msg', ['status' => 'danger', 'data' => 'Payment Cancelled.']);
    }
}
