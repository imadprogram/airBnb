<?php

namespace Ycode\AirBnb\Repositories;

use Ycode\AirBnb\Core\Database;


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
}