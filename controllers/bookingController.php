<?php
namespace Ycode\AirBnb\Controllers;

require_once __DIR__ . '/../vendor/autoload.php';

if(session_status() == PHP_SESSION_NONE){
    session_start();
}


use Ycode\AirBnb\Repositories\bookingRepository;
use Ycode\AirBnb\Repositories\RentalRepository;
use Ycode\AirBnb\Services\MailService;




class BookingController {
    private $bookingRepo;
    private $rentalRepo;

    public function __construct() {
        $this->bookingRepo = new bookingRepository;
        $this->rentalRepo = new RentalRepository;

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


        $now = date("Y-m-d", time());

        $repo = $this->rentalRepo->details($rental_id);
        $rental_name = $repo['title'];

        $mail = new MailService;

            if($check_in < $check_out && $check_in >= $now){
                if($this->bookingRepo->book($user_id , $rental_id , $check_in , $check_out , 'confirmed')){
                    $mail->sendBookingConfirmation($_SESSION['email'] , $_SESSION['name'] , $rental_name , $check_in , $check_out);
                    header("Location: ../views/details.php?id=$rental_id");
                    exit;
                }
            }else{
                $_SESSION['toast'] = [
                    'type' => 'failed',
                    'message' => 'choose a valid date'];
                header("Location: ../views/details.php?id=$rental_id");
                exit;
                }
    }

    
}





if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $bookControl = new BookingController;
    if($_POST['action'] === 'book'){
        $bookControl->book();
    }
}