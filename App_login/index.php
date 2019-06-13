<?php
    /*
     * Khởi động SESSION
     */
    session_start();
    /*
     * Kiểm tra xem người dùng đã đăng nhập chưa
     * nếu chưa đăng nhập thì redirect về trang login.php
     */
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
        // Chuyển hướng redirect trong php => sử dụng hàm header
        header("location: login.php");
        exit;
    }
    /*
     * Nếu như đã đăng nhập thành công
     */
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Đăng nhập thành công</h1>
                <p>Tên người dùng: <?php echo $_SESSION['username']?></p>
                <p><a href="logout.php">Log Out</a></p>
            </div>
        </div>
    </div>
</body>
</html>