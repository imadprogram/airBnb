<?php
namespace Ycode\AirBnb\Controllers;

require_once __DIR__ . '/../vendor/autoload.php';

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

use Ycode\AirBnb\Repositories\bookingRepository;

class BookingController {
    private $bookingRepo;

    public function __construct() {
        $this->bookingRepo = new bookingRepository;

        if(!isset($_SESSION['user_id'])){
            header('Location: ../views/login.php');
            exit;
        }
    }

    public function book() {
        $user_id = $_SESSION['user_id'];
        $rental_id = $_POST['rental_id'];
        $check_in = $_POST['check_in'];
        $check_out = $_POST['check_out'];

        // if($check_in > date('Y-m-d')){
            if($check_in < $check_out){
                if($this->bookingRepo->book($user_id , $rental_id , $check_in , $check_out , 'reserved')){
                    header("Location: ../views/details.php?id=$rental_id");
                }
            }
        // }
    }
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $bookControl = new BookingController;
    if($_POST['action'] === 'book'){
        $bookControl->book();
    }
}