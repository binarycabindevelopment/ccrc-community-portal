<?php

namespace App\Support\PaymentGateways\Fake;

use App\Support\PaymentGateways\PaymentGatewayInterface;
use App\Support\PaymentGateways\Responses\ChargeResponse;
use App\Support\PaymentGateways\Responses\CustomerResponse;
use App\Support\PaymentGateways\Responses\InvoiceResponse;
use App\Support\PaymentGateways\Responses\SubscriptionResponse;

class FakePaymentGateway implements PaymentGatewayInterface {

    public function createCustomer($attributes=[]){
        $response = new CustomerResponse();
        $response->setId('customer_'.rand(10000,99999));
        return $response;
    }

    public function updateCustomer($customer, $attributes=[]){
        return $customer;
    }

    public function charge($priceCents, $name, $attributes=[]){
        $response = new ChargeResponse();
        $response->setSuccess(true);
        $response->setId('test_charge_'.rand(10000,99999));
        return $response;
    }

    public function chargeToCustomer($priceCents, $name, $attributes=[]){
        $response = new ChargeResponse();
        $response->setSuccess(true);
        $response->setId('test_charge_'.rand(10000,99999));
        return $response;
    }

    public function findCustomer($attributes=[])
    {
        $response = new CustomerResponse();
        $response->setId($attributes['id']);
        return $response;
    }

    public function updateCustomerCard($customer, $attributes = [])
    {
        return $customer;
    }

    public function addSubscriptionToCustomer($customer, $planId, $quantity=1, $attributes=[])
    {
        $response = new SubscriptionResponse();
        $response->setId('test_subscription_'.rand(10000,99999));
        $response->setStatus('valid');
        return $response;
    }

    public function cancelSubscription($subscriptionId){
        $response = new SubscriptionResponse();
        $response->setId($subscriptionId);
        $response->setStatus('Cancelled');
    }

    public function findSubscription($subscriptionId)
    {
        $response = new SubscriptionResponse();
        $response->setId($subscriptionId);
        $response->setStatus('Active');
        return $response;
    }

    public function nextInvoiceForCustomer($customerId)
    {
        $response = new InvoiceResponse();
        $response->setPaymentDate(\Carbon\Carbon::now()->addDay(10));
        $response->setPaymentAmountCents(1000);
        return $response;
    }

    public function updateSubscriptionQuantity($subscriptionId,$newQuantity)
    {
        $response = new SubscriptionResponse();
        $response->setId('test_subscription_'.rand(10000,99999));
        $response->setStatus('valid');
        return $response;
    }

    public function subscriptionPlanCostCents($planId)
    {
        return 1000;
    }


}