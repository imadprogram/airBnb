<?php

namespace Ycode\AirBnb\Repositories;
use Ycode\AirBnb\Core\Database;
use PDO;


class RentalRepository {
    private $connection;


    public function __construct() {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function create($data) {
        $sql = "INSERT INTO rentals(host_id , title , price , city , image) VALUES(:host_id , :title , :price , :city , :image)";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            'host_id' => $data['host_id'],
            'title' => $data['title'],
            'price' => $data['price'],
            'city' => $data['city'],
            'image' => $data['image']
        ]);
    }

    // get all for host rentals
    public function getAll($host_id){
        $sql = "SELECT * FROM rentals WHERE host_id = :host_id";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute(['host_id' => $host_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id , $host_id , $title , $price , $city , $image){
        $sql = "UPDATE rentals SET title = :newTitle , price = :newPrice , city = :newCity , image = :newImage WHERE host_id = :host_id AND id = :id";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
                'newTitle' => $title,
                'newPrice' => $price,
                'newCity' => $city,
                'newImage' => $image,
                'host_id' => $host_id,
                'id' => $id
                ]);
    }

    public function delete($id , $host_id){
        $sqlRes = "DELETE FROM reservations WHERE rental_id = :id";
        $stmtRes = $this->connection->prepare($sqlRes);
        $stmtRes->execute([
            'id' => $id
        ]);


        $sqlFav = "DELETE FROM favorites WHERE rental_id = :id";
        $stmtFav = $this->connection->prepare($sqlFav);
        $stmtFav->execute([
            'id' => $id
        ]);

        $sqlRev = "DELETE FROM reviews WHERE rental_id = :id";
        $stmtRev = $this->connection->prepare($sqlRev);
        $stmtRev->execute([
            'id' => $id
        ]);

        $sql = "DELETE FROM rentals WHERE id = :id AND host_id = :host_id";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
                    'id' => $id,
                    'host_id' => $host_id]);
    }

    public function find($id , $host_id){
        $sql = "SELECT * FROM rentals WHERE id = :id AND host_id = :host_id";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute([
            'id' => $id,
            'host_id' => $host_id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // get all for traveler available rentals
    public function getAllListings(){
        $sql = "SELECT rentals.* , users.first_name AS host_first_name
                FROM rentals
                JOIN users ON rentals.host_id = users.id";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // find rental details to show them when clicking on the main page
    public function details($id){
        $sql = "SELECT rentals.* ,  users.first_name AS host_first_name ,
                                    users.last_name AS host_last_name ,
                                    users.email AS host_email
                FROM rentals
                JOIN users ON rentals.host_id = users.id
                WHERE rentals.id = :id";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function count(){
        $stmt = $this->connection->query("SELECT COUNT(*) FROM rentals");
        return $stmt->fetchColumn();
    }
    // get total numbers of rentals to calculat total pages
    public function getPaginated($limit , $offset) {
        $sql = "SELECT * FROM rentals ORDER BY id DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->connection->prepare($sql);

        $stmt->bindValue(':limit' , (int) $limit, \PDO::PARAM_INT);
        $stmt->bindValue(':offset' , (int) $offset, \PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}