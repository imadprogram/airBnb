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
            'rental_id' => $rental_id]);
    }

    public function getFavs($user_id) {
        $sql = "SELECT favorites.user_id,
                        favorites.rental_id as rental_id,
                        rentals.title as title, 
                        rentals.price as price, 
                        rentals.city as city, 
                        rentals.image as image
                FROM favorites
                JOIN rentals ON favorites.user_id = rentals.host_id AND favorites.rental_id = rentals.id
                WHERE favorites.user_id = :user_id";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute(['user_id' => $user_id]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteFav($user_id , $rental_id) {
        $sql = "DELETE FROM favorites WHERE user_id = :user_id AND rental_id = :rental_id";

        $stmt = $this->connection->prepare($sql);
        
        return $stmt->execute([
                'user_id' => $user_id,
                'rental_id' => $rental_id
                ]);
    }

}