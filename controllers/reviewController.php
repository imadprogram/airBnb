<?php
namespace Ycode\AirBnb\Controllers;

require_once __DIR__ . '/../vendor/autoload.php';

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

use Ycode\AirBnb\Repositories\ReviewRepository;




class ReviewController {
    private $reviewRepo;


    public function __construct() {
        $this->reviewRepo = new ReviewRepository;
    }

    public function addReview(){
        $user_id = $_SESSION['user_id'];
        $rental_id = $_POST['rental_id'];
        $rating = $_POST['rating'];
        $comment = $_POST['comment'];

        if($this->reviewRepo->addReview($user_id , $rental_id , $rating , $comment)){
            header("Location: ../views/details.php?id=$rental_id");
        }
    }

    public function getAll(){
        $rental_id = $_GET['id'];
        return $this->reviewRepo->getAll($rental_id);
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $control = new ReviewController;

    if($_POST['action'] == 'add_review'){
        $control->addReview();
    }
}