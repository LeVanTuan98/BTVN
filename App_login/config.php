<?php
/*
 * Khai báo các hằng số để kết nối CSDL
 */
define("DB_SERVER",'localhost');
define("DB_USER",'root');
define("DB_PASSWORD",'');
define("DB_NAME",'login');

/*
 *  Kết nối đến CSDL
 */
$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);

/*
 *  Kiểm tra xem kết nối đến CSDL có thành công không, nếu không thì sẽ ngắt chương trình bằng die;
 */
if($connection == false) {
    die("ERROR Không thể kết nối đến CSDL".mysqli_connect_error());
}
