<?php

namespace App\Support\PaymentGateways\Responses;

class ChargeResponse{

    private $id;
    private $message;
    private $success=false;

    public function setId($id){
    $this->id = $id;
}

    public function setMessage($message){
        $this->message = $message;
    }

    public function setSuccess($success){
        $this->success = $success;
    }

    public function getId(){
        return $this->id;
    }

    public function getMessage(){
        return $this->message;
    }

    public function getSuccess(){
        return $this->success;
    }

}