<?php

namespace App\Support\PaymentGateways\Stripe;

use App\Support\PaymentGateways\Stripe\StripePaymentGateway;
use Illuminate\Support\ServiceProvider;

class StripePaymentGatewayServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton('paymentGateway', function ($app) {
            return new StripePaymentGateway();
        });
    }

}