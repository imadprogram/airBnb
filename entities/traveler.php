<?php

namespace Ycode\AirBnb\Entities;


class Traveler extends User {

    public function __construct($firstName, $lastName, $email, $password, $id = null)
    {
        return parent::__construct('traveler' , $firstName, $lastName, $email, $password, null , $id);
    }

    public function bookRental($rental){

    }

    public function writeReview($rental){

    }

    public function canCancel($reservation) {
        return $reservation['user_id'] === $this->id;
    }
}