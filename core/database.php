<?php

namespace Ycode\AirBnb\Core;

use PDO;
use Exception;

class Database {
    private static $instance;
    private $connection;


    private function __construct() {
        try{
            $this->connection = new PDO ("mysql:host=localhost;dbname=airbnb", "root", "");
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(Exception $e){
            die('connection error: ' . $e->getMessage());
        }
    }

    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(){
        return $this->connection;
    }

    private function __clone(){}
    public function __wakeup(){
        throw new Exception("there is an error");
    }
}