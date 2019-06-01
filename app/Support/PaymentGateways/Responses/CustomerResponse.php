<?php

namespace App\Support\PaymentGateways\Responses;

class CustomerResponse{

    private $id;
    private $defaultCardBrand;
    private $defaultCardLast4;
    private $defaultCardExpMonth;
    private $defaultCardExpYear;

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setDefaultCardBrand($defaultCardBrand){
        $this->defaultCardBrand = $defaultCardBrand;
    }

    public function getDefaultCardBrand(){
        return $this->defaultCardBrand;
    }

    public function setDefaultCardLast4($defaultCardLast4){
        $this->defaultCardLast4 = $defaultCardLast4;
    }

    public function getDefaultCardLast4(){
        return $this->defaultCardLast4;
    }

    public function setDefaultCardExpMonth($defaultCardExpMonth){
        $this->defaultCardExpMonth = $defaultCardExpMonth;
    }

    public function getDefaultCardExpMonth(){
        return $this->defaultCardExpMonth;
    }

    public function setDefaultCardExpYear($defaultCardYear){
        $this->defaultCardExpYear = $defaultCardYear;
    }

    public function getDefaultCardExpYear(){
        return $this->defaultCardExpYear;
    }

}