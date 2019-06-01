<?php

namespace App\Support\PaymentGateways\Fake;

use Illuminate\Support\ServiceProvider;

class FakePaymentGatewayServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton('fakePaymentGateway', function ($app) {
            return new FakePaymentGateway();
        });
    }

}