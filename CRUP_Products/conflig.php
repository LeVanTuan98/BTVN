<?php
//Tạo ra 4 hằng số để kết nối CSDL

// Khai báo các hằng số
define("SERVER_NAME","localhost");
define("USER_NAME","root");
define("PASSWORD","");
define("DB_NAME","app_crup");

$connection = mysqli_connect(SERVER_NAME,USER_NAME,PASSWORD,DB_NAME);

// Kiểm tra kết nối đến CSDL có thành công không
if (!$connection) {
    die("Connection False!".mysqli_connect_error());
} else {
    echo "Connected successfully!";
}
