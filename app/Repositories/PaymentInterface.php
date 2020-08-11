<?php

namespace App\Repositories;

interface PaymentInterface
{
    public function paymentCancelled();
    public function initiatePayment(array $request);
    public function getPaymentSucceed($id);
    public function postPaymentSucceed(array $request);
}
