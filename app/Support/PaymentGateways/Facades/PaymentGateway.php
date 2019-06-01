<?php

namespace App\Support\PaymentGateways\Facades;

use Illuminate\Support\Facades\Facade;

class PaymentGateway extends Facade{

    public static function getFacadeAccessor(){
        return 'paymentGateway';
    }

}