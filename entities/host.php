<?php

namespace Ycode\AirBnb\Entities;

class Host extends User {

    public function __construct($firstName, $lastName, $email, $password, $company_name , $id = null)
    {
        return parent::__construct('host' , $firstName, $lastName, $email, $password , $company_name, $id);
    }

    public function createRental(){

    }
    public function deleteRental(){
        
    }

    public function canCancel($reservation) {
        return true;
    }
}