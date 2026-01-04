<?php

namespace Ycode\AirBnb\Entities;


abstract class User
{
    protected $role;
    protected $id;
    protected $firstName;
    protected $lastName;
    protected $email;
    protected $password;
    protected $company_name;


    public function __construct($role, $firstName, $lastName, $email, $password , $company_name=null , $id=null) {
        $this->role = $role;
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->company_name = $company_name;

    }

    public function getId() { return $this->id; }
    public function getRole() { return $this->role; }
    public function getFirstName() { return $this->firstName; }
    public function getLastName() { return $this->lastName; }
    public function getEmail() { return $this->email; }
    public function getPassword() { return $this->password; }
    public function getCompanyName() { return $this->company_name; }


    abstract public function canCancel($reservation);
}
