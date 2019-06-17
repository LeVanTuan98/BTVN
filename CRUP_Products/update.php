<?php
include_once "conflig.php";
if (isset($_POST['id']) && isset($_POST['product_name']) && isset($_POST['price']) && isset($_POST['product_inventory']) && isset($_POST['supplier']) && isset($_POST['date_added'])){
    if (!empty($_POST['product_name']) && !empty($_POST['price']) && !empty($_POST['product_inventory']) && !empty($_POST['supplier']) && !empty($_POST['date_added'])) {
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        $product_inventory = $_POST['product_inventory'];
        $supplier = $_POST['supplier'];
        $date_added = $_POST['date_added'];
        $id = $_POST['id'];

        $sqlInsert = "UPDATE products SET product_name = '$product_name' , price = $price , product_inventory = $product_inventory, supplier = '$supplier', date_added = '$date_added' WHERE id =".(int)$id;
        if (mysqli_query($connection, $sqlInsert)) {
            echo "Record updated successfully";            /**
             * hàm header được dùng để chuyển hướng url
             */
            header('location: index.php');
            exit;
        } else {
            echo "Error updating record: " . mysqli_error($connection);
        }
    }
}