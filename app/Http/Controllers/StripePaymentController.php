<?php

namespace App\Http\Controllers;

use App\Pricing;
use App\User;

use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Exception\CardException;
use Illuminate\Support\Facades\Auth;
use Stripe\Exception\ApiErrorException;
use Illuminate\Support\Facades\Response;
use Stripe\Exception\RateLimitException;
use Stripe\Exception\ApiConnectionException;
use Stripe\Exception\AuthenticationException;
use Stripe\Exception\InvalidRequestException;
use Illuminate\Support\Facades\Session;

class StripePaymentController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('stripe.secret'));
    }

    public function paymentOptions($id)
    {
        $package = Pricing::findorFail($id);
        return view('paymentOptions', compact('package', $package));
    }


    public function successPayment($session_id)
    {
        $session = StripeSession::retrieve($session_id);
        $accountBalance = Auth::user()->premium_jobs_balance;
        $newbalance = (($session->amount_total / 100) + $accountBalance);
        $updateBalance = User::findorFail(Auth::user()->id)->update(['premium_jobs_balance' => $newbalance]);

        Session::flash('msg', ['status' => 'success', 'data' => 'Payment Successful . Balance Added.']);
        return back();
    }
    public function cancelPayment()
    {
        Session::flash('msg', ['status' => 'danger', 'data' => 'Payment Cancelled.']);
        return back();
    }
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSession()
    {
        try {
            $session = StripeSession::create([
                'payment_method_types' => [
                    'card'
                ],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'bdt',
                        'product_data' => [
                            'name' => 'T-shirt',
                        ],
                        'unit_amount' => 2000 * 100,
                    ],
                    'quantity' => 1,
                ]],
                'locale' => 'auto',
                'client_reference_id' => Auth::user()->id,
                'mode' => 'payment',
                'success_url' => config('app.url') . 'success/session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => config('app.url') . 'cancel',
            ]);
            // dd($session);
            return Response::json($session);
        } catch (CardException $e) {
            Session::flash('msg', [
                'status' => 'danger',
                'data' => '
            Status is:' . $e->getHttpStatus() . '\n
            Type is:' . $e->getError()->type . '\n
            Code is:' . $e->getError()->code . '\n
            Param is:' . $e->getError()->param . '\n
            Message is:' . $e->getError()->message . ''
            ]);
        } catch (RateLimitException $e) {
            Session::flash('msg', [
                'status' => 'danger',
                'data' => 'Too many requests made to the API too quickly'
            ]);
        } catch (InvalidRequestException $e) {
            Session::flash('msg', [
                'status' => 'danger',
                'data' => 'Invalid parameters were supplied to Stripe\'s API'
            ]);
        } catch (AuthenticationException $e) {
            Session::flash('msg', [
                'status' => 'danger',
                'data' => 'Authentication with Stripe\'s API failed'
            ]);
        } catch (ApiConnectionException $e) {
            Session::flash('msg', [
                'status' => 'danger',
                'data' => 'Network communication with Stripe failed'
            ]);
        } catch (ApiErrorException $e) {
            Session::flash('msg', [
                'status' => 'danger',
                'data' => $e
            ]);
        } catch (Exception $e) {
            Session::flash('msg', [
                'status' => 'danger',
                'data' => $e
            ]);
        }
    }
}
