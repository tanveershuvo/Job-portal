<?php

namespace App\Http\Controllers;

use App\Pricing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;
use App\Repositories\Factories\PaymentFactory;

class PaymentChargeController extends Controller
{
    /**
     * Private variable
     *
     * @var
     */
    public $paymentFactory;
    public $paymentInterface;

    /**
     * Construct Payment Factory
     *
     * @param PaymentFactory $paymentFactory
     */

    public function __construct(PaymentFactory $paymentFactory)
    {
        $this->paymentFactory = $paymentFactory;
        if (Cache::has('paymentObject')) {
            $this->paymentInterface = Cache::get('paymentObject');
        }
    }

    /**
     * cacheObjectRemove method in order to remove cached object that sets in Payment Factory
     *
     * @return void
     */
    public function cacheObjectRemove()
    {
        return Cache::forget('paymentObject');
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
    public function getPaymentCancelled($id)
    {
        $this->paymentInterface->paymentCancelled($id);
        $this->cacheObjectRemove();
        return back();
    }

    /**
     * Payment Cancel function
     * @return Redirect
     */
    public function postPaymentCancelled(Request $request)
    {
        $this->paymentInterface->paymentCancelled($request);
        $this->cacheObjectRemove();
        return back();
    }

    /**
     * Get payment succeed for Get requesting in success page
     *
     * @param Request $request
     * @return Redirect to Successpage
     */
    public function getPaymentSucceed($id)
    {
        $this->paymentInterface->paymentSucceed($id);
        $this->cacheObjectRemove();
        return back();
    }

    /**
     * Post payment succeed for post requesting in success page
     *
     * @param Request $request
     * @return Redirect to Successpage
     */
    public function postPaymentSucceed(Request $request)
    {
        $this->paymentInterface->paymentSucceed($request->all());
        $this->cacheObjectRemove();
        return back();
    }
}
