<?php

namespace Ycode\AirBnb\Controllers;

require_once __DIR__ . '/../vendor/autoload.php';

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

use Ycode\AirBnb\Repositories\AdminRepository;


class AdminController {
    private $adminRepo;

    public function __construct() {
        $this->adminRepo = new AdminRepository;
    }

    public function dashboard() {
        return [
            'stats' => $this->adminRepo->getStats(),
            'allusers' => $this->adminRepo->getUsers(),
            'listings' => $this->adminRepo->getListings(),
            'reservations' => $this->adminRepo->getReservations()
        ];
    }
}