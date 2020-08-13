<?php

namespace App\Repositories\Factories;

use Illuminate\Support\Facades\App;
use App\Repositories\PaymentInterface;
use App\Repositories\SslPaymentRepository;
use App\Repositories\StripePaymentRepository;
use Illuminate\Support\Facades\Cache;

final class PaymentFactory
{
    public static function paymentOption($option)
    {
        if ($option == 'stripe') {
            App::bind(PaymentInterface::class, function ($app) {
                $stripe = new StripePaymentRepository;
                Cache::put('paymentObject', $stripe);
                return $stripe;
            });
        } elseif ($option == 'sslcommerz') {
            App::bind(PaymentInterface::class, function ($app) {
                $ssl =  new SslPaymentRepository;
                Cache::put('paymentObject', $ssl);
                return $ssl;
            });
        }
        return App::make(PaymentInterface::class);
    }
}
