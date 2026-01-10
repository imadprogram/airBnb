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

        return $stmt->fetchColumn();
    }
}
?>