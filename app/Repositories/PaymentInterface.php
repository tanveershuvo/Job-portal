<?php

namespace App\Repositories;

interface PaymentInterface
{
    public function paymentCancelled($data);
    public function initiatePayment(array $request);
    public function paymentSucceed($data);
}
