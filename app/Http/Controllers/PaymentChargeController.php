<?php

namespace App\Http\Controllers;

use App\Pricing;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\Factories\PaymentFactory;
use Illuminate\View\View;

class PaymentChargeController extends Controller
{
    /**
     * @var PaymentFactory
     */
    public $paymentFactory;
    /**
     * @var mixed
     */
    public $paymentInterface;

    /**
     * PaymentChargeController constructor.
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
     * @return $this
     */
    public function cacheObjectRemove()
    {
        Cache::forget('paymentObject');
        return $this;
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function paymentOptions($id)
    {
        $package = Pricing::findorFail($id);
        return view('paymentOptions', compact('package', $package));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function initiatePayment(Request $request)
    {
        $paymentInterface = $this->paymentFactory->paymentOption($request->option);
        $createdSession = $paymentInterface->initiatePayment($request->all());
        return response()->json($createdSession);
    }

    /**
     * Payment Cancel function
     * @param $id
     * @return RedirectResponse
     */
    public function getPaymentCancelled($id)
    {
        $this->paymentInterface->paymentCancelled($id);
        $this->cacheObjectRemove();
        return back();
    }

    /**
     * Payment Cancel function
     * @param Request $request
     * @return Redirect
     */
    public function postPaymentCancelled(Request $request)
    {
        $this->paymentInterface->paymentCancelled($request);
        $this->cacheObjectRemove();
        return back();
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function getPaymentSucceed($id)
    {
        $this->paymentInterface->paymentSucceed($id);
        $this->cacheObjectRemove();
        return back();
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function postPaymentSucceed(Request $request)
    {
        $this->paymentInterface->paymentSucceed($request->all());
        $this->cacheObjectRemove();
        return back();
    }
}
