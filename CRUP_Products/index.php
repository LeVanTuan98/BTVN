<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php
//    Nạp CSDL
    include_once "conflig.php";
    $sqlSelect = "SELECT * FROM products";
    $result = mysqli_query($connection, $sqlSelect);
?>

    <div class="container">
        <div class="row">
            <div style="margin: 30px 0">
                <a href="add.php" class="btn btn-success">Add product</a>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">ProductName</th>
                    <th scope="col">Price</th>
                    <th scope="col">Product Inventory</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Date Added</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <th scope="row"><?php echo $row['id']?> </th>
                            <td><?php echo $row['product_name']?> </td>
                            <td><?php echo $row['price']?> </td>
                            <td><?php echo $row['product_inventory']?> </td>
                            <td><?php echo $row['supplier']?> </td>
                            <td><?php echo $row['date_added']?> </td>
                            <td>
                                <div>
                                    <a class="btn btn-warning" href="edit.php?id=<?php echo $row['id'] ?>">Edit product</a>
                                </div>
                                <div>
                                    <a class="btn btn-danger" href="delete.php?id=<?php echo $row['id'] ?>">Delete product</a>
                                </div>
                            </td>
                        </tr>

                <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
