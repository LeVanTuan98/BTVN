<?php
session_start();
require_once "database.php";
$database = new Database();
/*
 * Kiểm tra xem form POST có gửi đi không và dữ liệu đó có rỗng không
 */
if (isset($_POST) && !empty($_POST)) {
    if(isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                if(isset($_POST['quantity']) && isset($_POST['product_id'])) {
                    $sql = "SELECT * FROM products WHERE id=".(int)$_POST['product_id'];
                    $product = $database->runQuery($sql);
                    $product = current($product); //Lấy dữ liệu trong mảng mà không còn vd như [0] => Array
                    $product_id = $product['id'];
                    if(isset($_SESSION['cart_item']) && !empty($_SESSION['cart_item'])) {
                        /*
                         * Khi giỏ hagf đã có dữ liệu
                         */
                        if(isset($_SESSION['cart_item'][$product_id])) {
                            $exist_cart_item = $_SESSION['cart_item'][$product_id];// Dữ liệu đã tồn tại trong giỏ hàng sau đó muốn cộng thêm dữ liệu mới vào
                            $exist_quantity = $exist_cart_item['quantity'];
                            $cart_item = array();
                            $cart_item['id'] = $product['id'];
                            $cart_item['name'] = $product['product_name'];
                            $cart_item['image'] = $product['product_image'];
                            $cart_item['price'] = $product['price'];
                            $cart_item['quantity'] = $_POST['quantity'] + $exist_quantity; // Cộng số liệu mới và số liệu đã tồn tại trước đó

                            $_SESSION['cart_item'][$product_id] = $cart_item;
                        } else {
                            // Sản phẩm chưa tồn tại trong giỏ hàng
                            $cart_item = array();
                            $cart_item['id'] = $product['id'];
                            $cart_item['name'] = $product['product_name'];
                            $cart_item['image'] = $product['product_image'];
                            $cart_item['price'] = $product['price'];
                            $cart_item['quantity'] = $_POST['quantity'];

                            $_SESSION['cart_item'][$product_id] = $cart_item;
                        }
                    } else {
                        /*
                         * Khi giỏ hàng chưa có dữ liệu
                         */
                        $_SESSION['cart_item'] =array();
                        $cart_item = array();
                        $cart_item['id'] = $product['id'];
                        $cart_item['name'] = $product['product_name'];
                        $cart_item['image'] = $product['product_image'];
                        $cart_item['price'] = $product['price'];
                        $cart_item['quantity'] = $_POST['quantity'];

                        $_SESSION['cart_item'][$product_id] = $cart_item;
                    }
                }
                break;
            case 'remove':
                if (isset($_POST['product_id'])) {
                    $product_id = $_POST['product_id'];
                    if(isset($_SESSION['cart_item'][$product_id])){
                        unset($_SESSION['cart_item'][$product_id]); // Xóa phần tử ra khỏi mảng
                    }
                }
                break;
            default:
                echo 'Action không tồn tại';
                die;//Ngắt đi không hoạt động nữa, không chạy tiếp nữa
        }
    }
}
header('location: index.php');
die;