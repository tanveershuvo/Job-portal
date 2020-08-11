<?php

namespace App\Repositories\Factories;

use App\Repositories\PaymentInterface;
use Illuminate\Support\Facades\App;
use App\Repositories\SslPaymentRepository;
use App\Repositories\StripePaymentRepository;

final class PaymentFactory
{
    public static function paymentOption($option)
    {
        if ($option == 'stripe') {
            App::bind(PaymentInterface::class, function ($app) {
                return new StripePaymentRepository;
            });
        } elseif ($option == 'sslcommerz') {
            App::bind(PaymentInterface::class, function ($app) {
                return new SslPaymentRepository;
            });
        }
        return App::make(PaymentInterface::class);
    }
}
