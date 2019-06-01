<?php

namespace App\Support\PaymentGateways\Stripe;

use App\Support\PaymentGateways\PaymentGatewayInterface;
use App\Support\PaymentGateways\Responses\ChargeResponse;
use App\Support\PaymentGateways\Responses\CustomerResponse;
use App\Support\PaymentGateways\Responses\InvoiceResponse;
use App\Support\PaymentGateways\Responses\SubscriptionResponse;
use Stripe\Error\InvalidRequest;

class StripePaymentGateway implements PaymentGatewayInterface {

    public function __construct()
    {
        $this->initAPIKey();
    }

    private function initAPIKey(){
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function findCharge($chargeId){
        $charge = \Stripe\Charge::retrieve($chargeId);
        return $charge;
    }

    public function refundCharge($chargeId, $amountCents){
        $chage = $this->findCharge($chargeId);
        $refundData = [];
        $createData['charge'] = $chargeId;
        $createData['amount'] = $amountCents;
        $refund = \Stripe\Refund::create($createData);
        return $refund;
    }

    public function createCustomer($attributes=[]){
        $token = $attributes['stripeToken'];
        $email = $attributes['email'];
        $description = $attributes['description'];
        $createData = [];
        $createData['source'] = $token;
        $createData['email'] = $email;
        $createData['description'] = $description;
        $customer = \Stripe\Customer::create($createData);
        $customerResponse = new CustomerResponse();
        $customerResponse->setId($customer->id);
        return $customerResponse;
    }

    public function findCustomer($attributes = [])
    {
        $customerId = $attributes['id'];
        $customer = \Stripe\Customer::retrieve($customerId);
        $customerResponse = new CustomerResponse();
        $customerResponse->setId($customer->id);
        $defaultSourceId = $customer->default_source;
        foreach($customer->sources->data as $source){
            if($source->id == $defaultSourceId){
                $customerResponse->setDefaultCardBrand($source->brand);
                $customerResponse->setDefaultCardLast4($source->last4);
                $customerResponse->setDefaultCardExpMonth($source->exp_month);
                $customerResponse->setDefaultCardExpYear($source->exp_year);
            }
        }
        return $customerResponse;
    }

    public function updateCustomer($customer, $attributes=[]){
        $token = $attributes['stripeToken'];
        $stripeCustomer = \Stripe\Customer::retrieve($customer->id);
        $stripeCustomer->source = $token;
        $stripeCustomer->save();
    }

    public function chargeToCustomer($priceCents, $name, $attributes=[]){
        $customerId = $attributes['customerId'];
        $attributes = [
            "amount" => $priceCents,
            "currency" => "usd",
            "description" => $name,
            "customer" => $customerId,
        ];
        $response = $this->createChargeFromAttributes($attributes);
        return $response;
    }

    public function authorizeToCustomer($priceCents, $name, $attributes=[]){
        \Log::info($attributes);
        $customerId = $attributes['customerId'];
        $attributes = [
            "amount" => $priceCents,
            "currency" => "usd",
            "description" => $name,
            "customer" => $customerId,
            "capture" => false,
        ];
        \Log::info($attributes);
        $response = $this->createChargeFromAttributes($attributes);
        return $response;
    }

    public function authorizeToSource($priceCents, $name, $attributes=[]){
        $source = $attributes['source'];
        $attributes = [
            "amount" => $priceCents,
            "currency" => "usd",
            "description" => $name,
            "source" => $source,
            "capture" => false,
        ];
        $response = $this->createChargeFromAttributes($attributes);
        return $response;
    }

    private function createChargeFromAttributes($attributes){
        $charge = \Stripe\Charge::create($attributes);
        $response = new ChargeResponse();
        if(empty($charge->id)){
            $response->setSuccess(false);
            $response->setMessage($charge->jsonSerialize());
        }else{
            $response->setSuccess(true);
            $response->setId($charge->id);
        }
        return $response;
    }

    public function charge($priceCents, $name, $attributes=[]){
        $charge = \Stripe\Charge::create(array(
            "amount" => $priceCents,
            "currency" => "usd",
            "description" => $name,
            "source" => $attributes['stripeToken'],
        ));
        $response = new ChargeResponse();
        if(empty($charge->id)){
            $response->setSuccess(false);
            $response->setMessage($charge->jsonSerialize());
        }else{
            $response->setSuccess(true);
            $response->setId($charge->id);
        }
        return $response;
    }

    public function updateCustomerCard($customer, $attributes = [])
    {
        $token = $attributes['stripeToken'];
        $stripeCustomer = \Stripe\Customer::retrieve($customer->getId());
        $stripeCustomer->source = $token;
        $stripeCustomer->save();
    }

    public function addSubscriptionToCustomer($customer, $planId, $quantity=1, $attributes=[])
    {
        $subscription = \Stripe\Subscription::create([
            'customer' => $customer->getId(),
            'plan' => $planId,
            'quantity' => $quantity,
        ]);
        $response = new SubscriptionResponse();
        $response->setId($subscription->id);
        $response->setStatus($subscription->status);
        return $response;
    }

    public function cancelSubscription($subscriptionId)
    {
        try{
            $subscription = \Stripe\Subscription::retrieve($subscriptionId);
        } catch (InvalidRequest $error){
            return null;
        }

        $subscription->cancel();
        $response = new SubscriptionResponse();
        $response->setId($subscription->id);
        $response->setStatus($subscription->status);
        return $response;
    }

    public function findSubscription($subscriptionId)
    {
        $subscription = \Stripe\Subscription::retrieve($subscriptionId);
        $response = new SubscriptionResponse();
        $response->setId($subscription->id);
        $response->setStatus($subscription->status);
        $response->setQuantity($subscription->quantity);
        $response->setPlanDateStart(\Carbon\Carbon::createFromTimestamp($subscription->current_period_start));
        $response->setPlanDateEnd(\Carbon\Carbon::createFromTimestamp($subscription->current_period_end));
        if(!empty($subscription->trial_start)){
            $response->setTrialDateStart(\Carbon\Carbon::createFromTimestamp($subscription->trial_start));
            $response->setTrialDateEnd(\Carbon\Carbon::createFromTimestamp($subscription->trial_end));
        }
        return $response;
    }

    public function nextInvoiceForCustomer($customerId)
    {
        try {
            $invoice = \Stripe\Invoice::upcoming([
                'customer' => $customerId,
            ]);
        }catch (\Exception $error){
            return null;
        }
        $response = new InvoiceResponse();
        $response->setPaymentDate(\Carbon\Carbon::createFromTimestamp($invoice->next_payment_attempt));
        $response->setPaymentAmountCents($invoice->amount_due);
        return $response;
    }

    public function updateSubscriptionQuantity($subscriptionId,$newQuantity)
    {
        try{
            $subscription = \Stripe\Subscription::retrieve($subscriptionId);
        } catch (InvalidRequest $error){
            return null;
        }
        $subscription->quantity = $newQuantity;
        $subscription->save();
        $response = new SubscriptionResponse();
        $response->setId($subscription->id);
        $response->setStatus($subscription->status);
        return $response;
    }

    public function subscriptionPlanCostCents($planId)
    {
        $plan = \Stripe\Plan::retrieve($planId);
        return $plan->amount;
    }

    public function captureAuthorizedCharge($chargeId)
    {
        $charge = \Stripe\Charge::retrieve($chargeId);
        if(!empty($charge->captured)){
            return true;
        }
        //dd($charge);
        try{
            $captureResponse = $charge->capture();
        } catch (\Stripe\Error\Base $e) {
            //If message contains "refunded", save this to the charge
            if (strpos($e->getMessage(), 'refunded') !== false) {
                $chargeModel = \App\Charge::where('stripe_charge_id',$chargeId)->first();
                if($chargeModel){
                    $chargeModel->response = 'refunded';
                    $chargeModel->save();
                }
            }
            \Log::error($charge->id.':'.$e->getMessage());
            return false;
        } catch (\Exception $e) {
            \Log::error($charge->id.':'.$e->getMessage());
            return false;
        }
        return $captureResponse;
    }

    public function voidCharge($chargeId)
    {
        $charge = \Stripe\Charge::retrieve($chargeId);
        return $charge->refund();
    }


}