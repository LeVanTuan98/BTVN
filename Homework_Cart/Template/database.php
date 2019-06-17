<?php

class Database {
    public $host = "localhost";
    public $user = "root";
    public $password = "";
    public $database = "db_cart";
    public $connection;

    /*
     * database constructor
     * Phương thức khởi tạo
     * được chạy khi bạn khởi tạo 1 class lên qua phương thức new
     * Vd: new Database();
     */
    public function __construct()
    {
        $this->connection = $this->connectDatabase();
    }
    /*
     * Phương thức kết nối đến CSDL
     */
    public function connectDatabase() {
        $connection = mysqli_connect($this->host,$this->user,$this->password,$this->database);
        mysqli_set_charset($connection,'utf8');
        return $connection;
    }
    /*
     * Phương thức chạy câu truy vấn SQL
     */
    public function runQuery($sql){
        $data = array();
        $result = mysqli_query($this->connection,$sql);

        while ($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
        return $data;
    }
    /*
     * Phương thức đếm số bản ghi trong câu lệnh Query
     */
    public function numRow($sql) {
        $result = mysqli_query($this->connection,$sql);
        $count = mysqli_num_rows($result);
        return $count;
    }
}
