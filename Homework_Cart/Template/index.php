<?php
require_once "database.php";
$database = new Database();
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style type="text/css">
        button i {
            color:orangered;
            text-align: center;
        }
        button {
            background: #ffffff;
            outline: none;
            border-radius: 5px;
            width:50px;
            height:38px;
            box-shadow: none;
            border: 1px solid orangered;
        }
        button:hover {
            background: orangered;
        }
        button:hover i {
            color: #ffffff;
        }
    </style>
</head>
<body>
<?php
    if(isset($_SESSION['cart_item']) && !empty($_SESSION['cart_item'])) {
?>
<div class="container">
    <h2 style="text-align: center;">Giỏ hàng</h2>
    <p>Chi tiết giỏ hàng của bạn</p>
    <table class="table">
        <thead>
        <tr>
            <th>ID sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Hình ảnh</th>
            <th>Giá tiền</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
            <th>Xóa khỏi giỏ hàng</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $total = 0;
        foreach ( $_SESSION['cart_item'] as $key_cart => $val_cart ) :
        ?>
        <tr>
            <td><?php echo $val_cart['id']?></td>
            <td><?php echo $val_cart['name']?></td>
            <td>
                <img class="card-img-top" style="width: 50px;display: block;margin: 0 auto;" data-holder-rendered="true" src="<?php echo $val_cart['image']?>">
            </td>
            <td><?php echo number_format($val_cart['price'],'0','.','.')?></td>
            <td><?php echo $val_cart['quantity']?></td>
            <td>
                <?php
                $total_item = ($val_cart['price']*$val_cart['quantity']);
                echo number_format($total_item,'0','.','.')
                ?>
            </td>
            <td>
                <form name="remove<?php echo $val_cart['id'] ?>" action="process.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $val_cart['id']?>">
                    <input type="hidden" name="action" value="remove">
                    <button type="submit">
                        <i class="fa fa-trash-o" aria-hidden="true" style="font-size: 26px;"></i>
                    </button>
                </form>
            </td>
        </tr>
        <?php
        $total += $total_item;
        endforeach;
        ?>
        </tbody>
    </table>
    <div>Tổng hóa đơn thanh toán: <strong><?php echo number_format($total,'0','.','.') ?></strong> VNĐ</div>


</div>
<?php } else {?>
        <div class="container">
            <h2 style="text-align: center;">Giỏ hàng</h2>
            <p>Giỏ hàng của bạn đang rỗng</p>
        </div>
<?php }?>
<div class="container" style="margin-top: 50px;">
    <div class="row">
        <?php
            $sql = "SELECT * FROM products";
            $products = $database->runQuery($sql);
        ?>
        <?php if (!empty($products)) : ?>
            <?php foreach ($products as $product): ?>
                <div class="col-sm-4">
                    <form action="process.php" name="product <?php echo $product['id']?>" method="post">
                        <div class="card mb-4 shadow-sm">
                            <img class="card-img-top" style="width: 220px;height: 175px;display: block;margin: 10px auto;" data-holder-rendered="true" src="<?php echo $product['product_image']?>">
                            <div class="card-body">
                                <p class="card-text" style="text-align: center; font-weight: bold;height: 48px;"><?php echo $product['product_name']?></p>
                                <p class="card-text" style="text-align: center; font-weight: 700;height: 48px;color: orange;"><?php echo number_format($product['price'],'0','.','.')?> VNĐ</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-inline" style="margin-left: 115px;">
                                        <label style="padding-right: 10px;">Số lượng: </label>
                                        <input type="text" name="quantity" value="1" class="form-control" style="width: 50px;">
                                        <input type="hidden" name="action" value="add">
                                        <input type="hidden" name="product_id" value="<?php echo $product['id']?>">
                                        <label style="padding-left: 10px;">
                                            <button type="submit"><i class="fa fa-shopping-cart" aria-hidden="true" style="font-size: 26px;"></i></button>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
</body>
</html>

