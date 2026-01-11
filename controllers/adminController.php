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

    public function suspend() {
        $user_id = $_POST['user_id'];

        $this->adminRepo->suspendUser($user_id);
    }

    public function activate() {
        $user_id = $_POST['user_id'];

        $this->adminRepo->activateUser($user_id);
    }
}



if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $adminControl = new AdminController;
    if(isset($_POST['action'])){
        if($_POST['action'] == 'suspend_user'){
            $adminControl->suspend();
            header('Location: ../views/admin_dashboard.php');
        }
        if($_POST['action'] == 'activate_user'){
            $adminControl->activate();
            header('Location: ../views/admin_dashboard.php');
        }
    }
}