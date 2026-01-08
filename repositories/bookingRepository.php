<?php

namespace Ycode\AirBnb\Repositories;

use Ycode\AirBnb\Core\Database;
use PDO;


class bookingRepository {
    private $connection;


    public function __construct() {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function book($user_id , $rental_id , $check_in , $check_out , $status) {
        $sql = "INSERT INTO reservations(user_id , rental_id , check_in , check_out , status)
                VALUES(:user_id , :rental_id , :check_in , :check_out , :status)";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            'user_id' => $user_id,
            'rental_id' => $rental_id,
            'check_in' => $check_in,
            'check_out' => $check_out,
            'status' => $status
        ]);
    }

    public function getAll($user_id) {
        $sql = "SELECT reservations.*, rentals.*
        FROM reservations
        JOIN rentals ON reservations.rental_id = rentals.id
        WHERE reservations.user_id = :user_id";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute([
            'user_id' => $user_id,
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getBookedDate($rental_id) {
        $sql = "SELECT check_in , check_out FROM reservations WHERE rental_id = :rental_id AND status != 'cancelled'";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute([
            'rental_id' => $rental_id
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}