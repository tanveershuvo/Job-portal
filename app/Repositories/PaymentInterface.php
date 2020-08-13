<?php

namespace App\Repositories;

interface PaymentInterface
{
    public function initiatePayment(array $data);
    public function paymentSucceed($data);
}
