<?php

namespace App\Http\Controllers;

use App\Pricing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $createdSession = $paymentInterface->initiatePayment($request->all());
        return response()->json($createdSession);
    }

    /**
     * Payment Cancel function
     * @return Redirect
     */
    public function stripePaymentCancelled(StripePaymentRepository $stripePaymentRepository)
    {
        $cancelledPayment = $stripePaymentRepository->paymentCancelled();
        return redirect($cancelledPayment);
    }

    /**
     * Payment Cancel function
     * @return Redirect
     */
    public function sslPaymentCancelled(StripePaymentRepository $stripePaymentRepository)
    {
        $cancelledPayment = $stripePaymentRepository->paymentCancelled();
        return redirect($cancelledPayment);
    }

    /**
     * Get payment succeed for Get requesting in success page
     *
     * @param Request $request
     * @return Redirect to Successpage
     */
    public function stripePaymentSucceed($id, StripePaymentRepository $stripePaymentRepository)
    {
        $stripePaymentRepository->getPaymentSucceed($id);
        return redirect()->back();
    }

    /**
     * Post payment succeed for post requesting in success page
     *
     * @param Request $request
     * @return Redirect to Successpage
     */
    public function sslPaymentSucceed(Request $request, SslPaymentRepository $sslPaymentRepository)
    {
        $sslPaymentRepository->postPaymentSucceed($request->all());
        return redirect()->back();
    }
}
