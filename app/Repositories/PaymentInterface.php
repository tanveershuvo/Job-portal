<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;

interface PaymentInterface
{
    public function paymentSucceed($id);
    public function paymentCancelled();
    public function initiatePayment(array $arr);
}
