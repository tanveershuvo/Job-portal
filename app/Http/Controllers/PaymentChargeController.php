<?php

namespace App\Http\Controllers;

use App\Pricing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use App\Repositories\PaymentInterface;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Repositories\SslPaymentRepository;
use App\Repositories\StripePaymentRepository;
use App\Repositories\Factories\PaymentFactory;

class PaymentChargeController extends Controller
{
    /**
     * Private variable
     *
     * @var
     */
    public $paymentFactory;

    /**
     * Construct Payment Factory
     *
     * @param PaymentFactory $paymentFactory
     */

    public function __construct(PaymentFactory $paymentFactory)
    {
        //$this->middleware('auth:web');
        $this->paymentFactory = $paymentFactory;
    }

    /**
     * Showing payment Option Page
     *
     * @param int $id
     * @return View
     */
    public function paymentOptions($id)
    {
        $package = Pricing::findorFail($id);
        return view('paymentOptions', compact('package', $package));
    }

    /**
     * Initiate payment session
     *
     * @param Request $request
     * @factoryPattern Implemented PaymentFactory
     * #session set paymentMethodObject
     * @todo Initiate payment session
     * @return Response
     */
    public function initiatePayment(Request $request)
    {
        $paymentInterface = $this->paymentFactory->paymentOption($request->option);
        Session::put('paymentInterface', $paymentInterface);
        $createdSession = $paymentInterface->initiatePayment($request->all());
        return response()->json($createdSession);
    }

    /**
     * Payment Cancel function
     * @session for getting paymentMethodObject
     * @session get
     * @session destroy
     * @return Redirect
     */
    public function paymentCancelled()
    {
        $paymentInterface = Session::get('paymentInterface');
        $cancelledPayment = $paymentInterface->paymentCancelled();
        Session::forget('paymentInterface');
        return redirect($cancelledPayment);
    }

    /**
     * Get payment succeed for Get requesting in success page
     *
     * @param Request $request
     * @session used for holding the implementation of the imterface
     * @session get
     * @session destroy
     * @return Redirect to Successpage
     */
    public function getPaymentSucceed($id)
    {
        $paymentInterface = Session::get('paymentInterface');
        $paymentInterface->getPaymentSucceed($id);
        Session::forget('paymentInterface');
        return redirect()->back();
    }

    /**
     * Post payment succeed for post requesting in success page
     *
     * @param Request $request
     * @session used for holding the implementation of the imterface
     * @session get
     * @session destroy
     * @return Redirect to Successpage
     */
    public function postPaymentSucceed(Request $request)
    {
        $paymentInterface = Session::get('paymentInterface');
        $paymentInterface->postPaymentSucceed($request->all());
        Session::forget('paymentInterface');
        return redirect()->back();
    }
}
