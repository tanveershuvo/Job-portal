<?php

namespace App\Http\Controllers;

use App\Pricing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;
use App\Repositories\Factories\PaymentFactory;

class PaymentChargeController extends Controller
{
    /**
     * Private variable
     *
     * @var
     */

    private $paymentFactory;

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
     * @todo Initiate payment session
     * @return Response
     */

    public function initiatePayment(Request $request)
    {
        $paymentMethod = $this->paymentFactory->paymentOption($request->option);
        $createdSession = $paymentMethod->initiatePayment($request->all());
        return Response::json($createdSession);
    }
}
