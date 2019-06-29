<?php
/*
 * Chuyển đổi từ mảng/ đối tượng trong PHP thành chuỗi JSON => Mã hóa
 */
$phpArray = array("Hà Nội", "Hồ Chí Minh", "Đà Nẵng");

class student {
    public $name;
    public $age;
    public $location;

    public function __construct($name,$age,$location){
        $this->name = $name;
        $this->age = $age;
        $this->location = $location;
    }
}
$tuan = new student("Lê Văn Tuấn",21,"Nghệ An");

echo "<pre>";
print_r($phpArray);
echo "</pre>";


echo "<pre>";
print_r($tuan);
echo "</pre>";

$phpJson1 = json_encode($phpArray);
echo "<pre>";
print_r($phpJson1);
echo "</pre>";

$phpJson2 = json_encode($tuan);
echo "<pre>";
print_r($phpJson2);
echo "</pre>";