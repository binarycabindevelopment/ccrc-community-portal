<?php

namespace App\Support\PaymentGateways\Responses;

use App\Support\Traits\HasCents;
use Carbon\Carbon;

class InvoiceResponse{

    use HasCents;

    private $paymentDate;
    private $paymentAmountCents;

    public function setPaymentDate($paymentDate){
        $this->paymentDate = $paymentDate;
    }

    public function getPaymentDate(){
        return $this->paymentDate;
    }

    public function setPaymentAmountCents($paymentAmountCents){
        $this->paymentAmountCents = $paymentAmountCents;
    }

    public function getPaymentAmountCents(){
        return $this->paymentAmountCents;
    }

    public function getPaymentAmount(){
        return static::centsToDollars($this->paymentAmountCents);
    }

}