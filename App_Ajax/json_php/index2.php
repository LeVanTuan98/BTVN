<?php
/*
 * Chuyển đổi chuỗi JSON thành mảng hoặc đối tượng => Giải mã
 */
$json1 = '["H\u00e0 N\u1ed9i","H\u1ed3 Ch\u00ed Minh","\u0110\u00e0 N\u1eb5ng"]';
$json2 = '{"name":"L\u00ea V\u0103n Tu\u1ea5n","age":21,"location":"Ngh\u1ec7 An"}';

$convert1 = json_decode($json1);
echo "<pre>";
print_r($convert1);
echo "</pre>";

$convert2 = json_decode($json2);
echo "<pre>";
print_r($convert2);
echo "</pre>";