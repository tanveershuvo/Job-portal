<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Stripe\Charge;
use Stripe\Stripe;

class StripePaymentController extends Controller
{
    public function stripe()
    {
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {

        Stripe::setApiKey(config('stripe.secret'));
        Charge::create([
            "amount" => $request->amount,
            "currency" => "usd",
            "source" => $request->stripeToken,
        ]);
        $accountBalance = Auth::user()->premium_jobs_balance;
        $newbalance = ($request->amount + $accountBalance);
        $updateBalance = User::findorFail(Auth::user()->id)->update(['premium_jobs_balance' => $newbalance]);

        Session::flash('success', 'Balance Added!');

        return back();
    }
}
