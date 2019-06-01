<?php

namespace App\Support\PaymentGateways\Responses;

use Carbon\Carbon;

class SubscriptionResponse{

    private $id;
    private $status;
    private $quantity;
    private $trialDateStart;
    private $trialDateEnd;
    private $planDateStart;
    private $planDateEnd;

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setStatus($status){
        $this->status = $status;
    }

    public function getStatus(){
        return $this->status;
    }

    public function setQuantity($quantity){
        $this->quantity = $quantity;
    }

    public function getQuantity(){
        return $this->quantity;
    }

    public function setPlanDateStart($planDateStart){
        $this->planDateStart = $planDateStart;
    }

    public function getPlanDateStart(){
        return $this->planDateStart;
    }

    public function setPlanDateEnd($planDateEnd){
        $this->planDateEnd = $planDateEnd;
    }

    public function getPlanDateEnd(){
        return $this->planDateEnd;
    }

    public function setTrialDateStart($trialDateStart){
        $this->trialDateStart = $trialDateStart;
    }

    public function getTrialDateStart(){
        return $this->trialDateStart;
    }

    public function setTrialDateEnd($trialDateEnd){
        $this->trialDateEnd = $trialDateEnd;
    }

    public function getTrialDateEnd(){
        return $this->trialDateEnd;
    }

    public function getNextBillingDate(){
        if(Carbon::now() < $this->trialDateEnd){
            return $this->trialDateEnd;
        }
        return $this->planDateEnd;
    }

}