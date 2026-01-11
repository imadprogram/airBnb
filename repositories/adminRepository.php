<?php
namespace Ycode\AirBnb\Repositories;

use Ycode\AirBnb\Core\Database;
use PDO;

class AdminRepository {
    private $connection;


    public function __construct() {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function getStats() {
        $sql = "SELECT COUNT(*) FROM users";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute();

        $totalUsers = $stmt->fetchColumn();


        $sql1 = "SELECT COUNT(*) FROM rentals";

        $stmt1 = $this->connection->prepare($sql1);

        $stmt1->execute();

        $totalRentals = $stmt1->fetchColumn();


        $sql2 = "SELECT COUNT(*) FROM reservations";

        $stmt2 = $this->connection->prepare($sql2);

        $stmt2->execute();

        $totalReservations = $stmt2->fetchColumn();



        return [
            'totalUsers' => $totalUsers,
            'totalRentals' => $totalRentals,
            'totalReservations' => $totalReservations
        ];
    }

    public function getUsers() {
        $sql = "SELECT * FROM users";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getListings() {
        $sql = "SELECT rentals.* , users.first_name , users.last_name
                FROM rentals
                JOIN users ON rentals.host_id = users.id";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>