<?php

namespace App\Services;

interface PaymentServiceInterface
{
    public const PAYMENT_PENDING = 'pending';
    public const PAYMENT_COMPLETE = 'complete';

    public function execute();
}