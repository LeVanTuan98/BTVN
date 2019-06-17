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
$product_name = '';
$price = '';
$product_inventory = '';
$supplier = '';
$date_added = '';
if (isset($_GET['id'])){
    $employee_id = (int)$_GET['id'];
    $sqlSelect = "SELECT * FROM products WHERE id = $employee_id";
    $result = mysqli_query($connection, $sqlSelect);
    $row = mysqli_fetch_assoc($result);

    $product_name = isset($row['product_name']) ? $row['product_name'] : '';
    $price = isset($row['price']) ? $row['price'] : '';
    $product_inventory = isset($row['product_inventory']) ? $row['product_inventory'] : '';
    $supplier = isset($row['supplier']) ? $row['supplier'] : '';
    $date_added = isset($row['date_added']) ? $row['date_added'] : '';
}


?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Edit product</h1>
            <form name="edit" action="update.php" method="post">
                <input type="hidden" name="id" value="<?php echo $employee_id ?>">
                <div class="form-group">
                    <label>Name Product</label>
                    <input type="text" class="form-control" name="product_name" value="<?php echo $row['product_name']?>">
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="text" class="form-control" name="price" value="<?php echo $row['price']?>">
                </div>
                <div class="form-group">
                    <label>Product Inventory</label>
                    <input type="text" class="form-control" name="product_inventory" value="<?php echo $row['product_inventory']?>">
                </div>
                <div class="form-group">
                    <label>Supplier</label>
                    <input type="text" class="form-control" name="supplier" value="<?php echo $row['supplier']?>">
                </div>
                <div class="form-group">
                    <label>Date Added</label>
                    <input type="date" class="form-control" name="date_added" value="<?php echo $row['date_added']?>">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>

