<?php

namespace Ycode\AirBnb\Entities;


class Admin extends User {

    public function banUser(){

    }
    public function deleteReview(){

    }
    public function getDashboardStats(){

    }
    public function activateUser(){

    }

    public function canCancel($reservation) {
        return true;
    }
}