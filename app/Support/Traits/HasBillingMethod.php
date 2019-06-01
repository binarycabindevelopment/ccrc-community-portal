<?php

namespace App\Support\Traits;

use \PaymentGateway;

trait HasBillingMethod{

    public function hasValidBillingMethod(){
        if($this->getBillingMethodCustomer()){
            return true;
        }
        return false;
    }

    public function getBillingMethodCustomer(){
        if(empty($this->stripe_customer_id)){
            return null;
        }
        $customer = PaymentGateway::findCustomer(['id'=>$this->stripe_customer_id]);
        return $customer;
    }

    public function updateBillingMethod($attributes = []){
        if(empty($this->stripe_customer_id)){
            $attributes['email'] = $this->email;
            $attributes['description'] = 'UserId:'.$this->id;
            $customer = PaymentGateway::createCustomer($attributes);
            $this->stripe_customer_id = $customer->getId();
            $this->save();
        }else{
            $customer = $this->getBillingMethodCustomer();
            if($customer){
                PaymentGateway::updateCustomerCard($customer,$attributes);
            }
        }
    }

}