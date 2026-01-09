<?php
namespace Ycode\AirBnb\Controllers;

use Ycode\AirBnb\Repositories\FavoritesRepository;

require_once __DIR__ . '/../vendor/autoload.php';

if(session_status() == PHP_SESSION_NONE){
    session_start();
}



class FavoritesController {
    private $favoriteRepo;

    public function __construct() {
        $this->favoriteRepo = new FavoritesRepository;
    }


    public function addFav() {
        $user_id = $_SESSION['user_id'];
        $rental_id = $_POST['rental_id'];

        if($this->favoriteRepo->addFav($user_id , $rental_id)) {
                $_SESSION['toast'] = [
                    'type' => 'success',
                    'message' => 'Added to favorites'];
        }
    }

    public function removeFav() {
        $user_id = $_SESSION['user_id'];
        $rental_id = $_POST['rental_id'];

        if($this->favoriteRepo->deleteFav($user_id , $rental_id)){
            $_SESSION['toast'] = [
                'type' => 'success',
                'message' => 'remove from favorites'
            ];
        }
    }
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $controll = new FavoritesController;

    if($_POST['action'] == 'toggle_favorite'){
        $controll->addFav();
        header('Location: ../views/index.php');
    }else if($_POST['action'] == 'remove_favorite'){
        $controll->removeFav();
        header('Location: ../views/favorites.php');
    }
}