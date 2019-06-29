<?php
class Database {
    public static $connection = null ;

    public function __construct(){
        if(self::$connection) {
            return self::$connection;
        } else {
            $this->connect();
            return self::$connection;
        }
    }

    public function connect() {
        $severName = "localhost";
        $userName = "root";
        $password = "";
        $dbName = "app_ajax";

        self::$connection = new mysqli($severName,$userName,$password,$dbName);

        if(self::$connection->connect_error) {
            die("Không thể kết nối đến CSDL");
        }
    }

    public function disconnect() {
        if(self::$connection) {
            self::$connection->close();
        }
    }
}