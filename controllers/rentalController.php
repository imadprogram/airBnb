<?php
namespace Ycode\AirBnb\Controllers;

require_once __DIR__ . '/../vendor/autoload.php';

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

use Ycode\AirBnb\Repositories\RentalRepository;





class RentalController {

    private $rentalRepo;

    public function __construct(){
        $this->rentalRepo = new RentalRepository;
    }

    public function getRentals() {
        return $this->rentalRepo->getAll($_SESSION['user_id']);
    }

    public function addRental(){
        $title = htmlspecialchars($_POST['title']);
        $city = htmlspecialchars($_POST['city']);
        $price = $_POST['price'];

        $imagePath = null;

        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
            $imageName = $_FILES['image']['name'];
            $imageTemp = $_FILES['image']['tmp_name'];


            $newFileName = 'listing_'.time().$imageName;

            $uploadDestination = '../uploads/listings/'.$newFileName;

            if(move_uploaded_file($imageTemp , $uploadDestination)){

                $imagePath = 'uploads/listings/'.$newFileName;
            }else{
                exit;
            }
        }

        $data = [
            'host_id' => $_SESSION['user_id'],
            'title' => $title,
            'price' => $price,
            'city' => $city,
            'image' => $imagePath
        ];
        if($this->rentalRepo->create($data)){
            header('Location: ../views/host_dashboard.php');
        }
    }

    public function updateRental() {

        $title = htmlspecialchars($_POST['title']);
        $city = htmlspecialchars($_POST['city']);
        $price = $_POST['price'];
        $id = $_POST['id'];

        $imagePath = null;

        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
            $imageName = $_FILES['image']['name'];
            $imageTemp = $_FILES['image']['tmp_name'];


            $newFileName = 'listing_'.time().$imageName;

            $uploadDestination = '../uploads/listings/'.$newFileName;

            if(move_uploaded_file($imageTemp , $uploadDestination)){

                $imagePath = 'uploads/listings/'.$newFileName;
            }else{
                exit;
            }
        }

        if($imagePath ==  null){
            $previous = $this->rentalRepo->find($id , $_SESSION['user_id']);
            $imagePath = $previous['image'];
        }


        if($this->rentalRepo->update($id , $_SESSION['user_id'] , $title , $price , $city , $imagePath)){
            header('Location: ../views/host_dashboard.php');
        }
    }

    public function removeRental() {

    }

}





if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $controller = new rentalController;

    if(isset($_POST['action'])){
        if($_POST['action'] == 'create_rental'){
            $controller->addRental();
        }else if($_POST['action'] == 'update_rental'){
            $controller->updateRental();
        }

    }
}