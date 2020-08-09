<?php

namespace App\Repositories\Factories;

use App\Repositories\SslPaymentRepository;
use App\Repositories\StripePaymentRepository;

class PaymentFactory
{
    public static function paymentOption($option)
    {
        if ($option == 'stripe') {
            return new StripePaymentRepository;
        } elseif ($option == 'sslcommerz') {
            return new SslPaymentRepository;
        }
    }
}
