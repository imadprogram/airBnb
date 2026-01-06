<?php

namespace Ycode\AirBnb\Repositories;
use Ycode\AirBnb\Core\Database;
use PDO;

class ReviewRepository {
    private $connection;

    
    public function __construct() {
        $this->connection = Database::getInstance()->getConnection();
    }

    public function addReview($user_id , $rental_id , $rating , $comment){
        $sql = "INSERT INTO reviews(rating , comment , user_id , rental_id)
                VALUES(:rating , :comment , :user_id , :rental_id)";

        $stmt = $this->connection->prepare($sql);

        return $stmt->execute([
            'rating' => $rating,
            'comment' => $comment,
            'user_id' => $user_id,
            'rental_id' => $rental_id
        ]);
    }
}