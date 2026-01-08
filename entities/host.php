<?php

namespace Ycode\AirBnb\Entities;

class Host extends User {

    public function __construct($firstName, $lastName, $email, $password , $id = null){
        parent::__construct('host' , $firstName, $lastName, $email, $password , $id);
    }

    public function createRental(){

    }
    public function deleteRental(){
        
    }

    public function canCancel($reservation) {
        return true;
    }
}