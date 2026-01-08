<?php

namespace Ycode\AirBnb\Repositories;

use Ycode\AirBnb\Core\Database;
use Ycode\AirBnb\Entities\User;
use PDO;
use Ycode\AirBnb\Entities\Admin;
use Ycode\AirBnb\Entities\Host;
use Ycode\AirBnb\Entities\Traveler;

class UserRepository {
    private $connection;

    public function __construct() {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function find($id) {
        $sql = "SELECT * FROM users WHERE id = :id";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute([
            'id' => $id
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$row) return null;

        if($row['role'] == 'host'){
            return new Host($row['first_name'] , $row['last_name'] , $row['email'] , $row['password'] , $row['id']);
        }else if($row['role'] == 'traveler'){
            return new Traveler($row['first_name'] , $row['last_name'] , $row['email'] , $row['password'] , $row['id']);
        }else if($row['role'] == 'admin'){
            return new Admin($row['first_name'] , $row['last_name'] , $row['email'] , $row['password'] , $row['id']);
        }

        return null;
    }

    public function findByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute([
            ':email' => $email
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(User $user) {
        $sql = "INSERT INTO users(first_name , last_name , email , password , role ) VALUES(:first_name , :last_name , :email , :password , :role )";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
                                ':first_name' => $user->getFirstName(),
                                ':last_name' => $user->getLastName(),
                                ':email' => $user->getEmail(),
                                ':password' => $user->getPassword(),
                                ':role' => $user->getRole(),
                            ]);
    }
}