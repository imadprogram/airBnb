<?php

namespace Ycode\AirBnb\Repositories;

use Ycode\AirBnb\Core\Database;
use PDO;



class FavoritesRepository {
    private $connection;

    public function __construct() {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function addFav($user_id , $rental_id) {
    $sql = "INSERT INTO favorites(user_id , rental_id) VALUES(:user_id , :rental_id)";

    $stmt = $this->connection->prepare($sql);

    return $stmt->execute([
        'user_id' => $user_id,
        'rental_id' => $rental_id
    ]);
    }
}