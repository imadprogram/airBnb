<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';


use Ycode\AirBnb\Entities\Host;
use Ycode\AirBnb\Entities\Traveler;
use Ycode\AirBnb\Repositories\UserRepository;

class AuthController {

    private $userRepo;

    public function __construct() {
        $this->userRepo = new UserRepository;
    }


    public function register() {
        $first_name = htmlspecialchars($_POST['first_name']);
        $last_name = htmlspecialchars($_POST['last_name']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        $role = $_POST['role'];
        $company_name = $_POST['company_name'] ?? null;

        if($this->userRepo->findByEmail($email)){
            header('location: ../views/signup.php');
            exit;
        }

        $hashedPass = password_hash($password , PASSWORD_DEFAULT);

        if($role == 'host'){
            $newUser = new Host($first_name , $last_name , $email , $hashedPass , $company_name);
        }else{
            $newUser = new Traveler($first_name , $last_name , $email , $hashedPass);
        }

        if($this->userRepo->create($newUser)){
            header('Location: ../views/login.php');
        }
        exit;
    }

    public function login(){
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        $user = $this->userRepo->findByEmail($email);

        if($user && password_verify($password , $user['password'])){
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['first_name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['email'] = $email;

            if($user['role'] == 'host'){
                header('Location: ../views/host_dashboard.php');
            }else if($user['role'] == 'traveler'){
                header('Location: ../views/index.php');
            }else{
                header('Location: ../views/admin_dashboard.php');
            }
            exit;
        }else{
            header('Location: ../views/login.php');
            $_SESSION['error'] = 'wrong email or pass';
        }
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $controller = new AuthController();

    if(isset($_POST['action']) && $_POST['action'] == 'register'){
        $controller->register();
    }else if(isset($_POST['action']) && $_POST['action'] == 'login'){
        $controller->login();
    }
}