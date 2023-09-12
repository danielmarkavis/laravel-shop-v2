<?php

namespace App\Services;

class PaypalGateway implements PaymentServiceInterface
{
    public function execute(): string
    {
        return self::PAYMENT_COMPLETE;
    }
}