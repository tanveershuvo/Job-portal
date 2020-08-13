<?php

namespace App\Repositories\Factories;

use Illuminate\Support\Facades\App;
use App\Repositories\PaymentInterface;
use Illuminate\Support\Facades\Session;
use App\Repositories\SslPaymentRepository;
use App\Repositories\StripePaymentRepository;

final class PaymentFactory
{
    public static function paymentOption($option)
    {
        if ($option == 'stripe') {
            App::bind(PaymentInterface::class, function ($app) {
                $stripe = new StripePaymentRepository;
                return $stripe;
            });
        } elseif ($option == 'sslcommerz') {
            App::bind(PaymentInterface::class, function ($app) {
                $ssl =  new SslPaymentRepository;
                return $ssl;
            });
        }
        return App::make(PaymentInterface::class);
    }
}
