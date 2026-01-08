<?php
namespace Ycode\AirBnb\Controllers;

require_once __DIR__ . '/../vendor/autoload.php';

if(session_status() == PHP_SESSION_NONE){
    session_start();
}


use Ycode\AirBnb\Repositories\bookingRepository;
use Ycode\AirBnb\Repositories\RentalRepository;
use Ycode\AirBnb\Services\MailService;
use Ycode\AirBnb\Repositories\UserRepository;




class BookingController {
    private $bookingRepo;
    private $rentalRepo;
    private $userRepo;

    public function __construct() {
        $this->bookingRepo = new bookingRepository;
        $this->rentalRepo = new RentalRepository;
        $this->userRepo = new UserRepository;

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
                }else{
                    $_SESSION['toast'] = [
                        'type' => 'failed',
                        'message' => 'those dates are no longer available'];
                }
            }else{
                $_SESSION['toast'] = [
                    'type' => 'failed',
                    'message' => 'choose a valid date'];
                header("Location: ../views/details.php?id=$rental_id");
                exit;
                }
    }

    public function getAll() {
        return $this->bookingRepo->getAll($_SESSION['user_id']);
    }

    public function cancelBooking() {
        $reservation_id = $_POST['reservation_id'];

        $reservation = $this->bookingRepo->getById($reservation_id);

        if(!$reservation){
            $_SESSION['toast'] = ['type' => 'failed', 'message' => 'Reservation not found'];
            header("Location: ../views/trips.php");
            exit;
        }

        $current_user = $this->userRepo->find($_SESSION['user_id']);

        if($current_user && $current_user->canCancel($reservation)){
            if($this->bookingRepo->cancel($reservation_id)){
                $_SESSION['toast'] = ['type' => 'success', 'message' => 'Trip cancelled successfully'];
            }else{
                $_SESSION['toast'] = ['type' => 'failed', 'message' => 'Error cancelling trip'];
            }
        }else{
            $_SESSION['toast'] = ['type' => 'failed', 'message' => 'Unauthorized action'];
        }

        header("Location: ../views/myTrips.php");
        exit;
    }
}





if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $bookControl = new BookingController;
    if($_POST['action'] === 'book'){
        $bookControl->book();
    }else if($_POST['action'] === 'cancel_booking'){
        $bookControl->cancelBooking();
    }
}