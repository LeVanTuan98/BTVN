<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php
    include_once "conflig.php";
    if (isset($_POST['product_name']) && isset($_POST['price']) && isset($_POST['product_inventory']) && isset($_POST['supplier']) && isset($_POST['date_added'])){
        if (!empty($_POST['product_name']) && !empty($_POST['price']) && !empty($_POST['product_inventory']) && !empty($_POST['supplier']) && !empty($_POST['date_added'])) {
            $product_name = $_POST['product_name'];
            $price = $_POST['price'];
            $product_inventory = $_POST['product_inventory'];
            $supplier = $_POST['supplier'];
            $date_added = $_POST['date_added'];

            $sqlInsert = "INSERT INTO products (product_name, price, product_inventory, supplier, date_added) VALUE ('$product_name', $price, $product_inventory, '$supplier', '$date_added')";
            if (mysqli_query($connection, $sqlInsert)) {
                echo "New record created successfully";
                /**
                 * hàm header được dùng để chuyển hướng url
                 */
                header('location: index.php');
                exit;
            } else {
                echo "Error: " . $sqlInsert . "<br>" . mysqli_error($connection);
            }
        }
    }
?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Add product</h1>
                <form name="add" action="#" method="post">
                    <div class="form-group">
                        <label>Name Product</label>
                        <input type="text" class="form-control" name="product_name" >
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" class="form-control" name="price" >
                    </div>
                    <div class="form-group">
                        <label>Product Inventory</label>
                        <input type="text" class="form-control" name="product_inventory" >
                    </div>
                    <div class="form-group">
                        <label>Supplier</label>
                        <input type="text" class="form-control" name="supplier" >
                    </div>
                    <div class="form-group">
                        <label>Date Added</label>
                        <input type="date" class="form-control" name="date_added" >
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
