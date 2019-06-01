<?php

namespace App\Support\PaymentGateways;

interface PaymentGatewayInterface{

    public function createCustomer($attributes=[]);

    public function findCustomer($attributes=[]);

    public function updateCustomer($customer, $attributes=[]);

    public function charge($priceCents, $name, $attributes=[]);

    public function chargeToCustomer($priceCents, $name, $attributes=[]);

    public function updateCustomerCard($customer,$attributes=[]);

    public function addSubscriptionToCustomer($customer, $planId, $quantity=1, $attributes=[]);

    public function cancelSubscription($subscriptionId);

    public function findSubscription($subscriptionId);

    public function nextInvoiceForCustomer($customerId);

    public function updateSubscriptionQuantity($subscriptionId,$newQuantity);

    public function subscriptionPlanCostCents($planId);

}