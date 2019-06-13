<?php
    session_start();
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true ) {
        header('location: index.php');
        exit;
    }
    /*
     * Nạp file kết nối CSDL
     */
    include_once "config.php";
    /*
     * Biến lưu trữ lỗi trong quá tình đăng nhập
     */
    $error = array();
    /*
     * Xử lý đăng nhập
     */
    if(isset($_POST) && !empty($_POST)) {
        if(!isset($_POST['username']) || empty($_POST['username'])) {
            $error[] = "Chưa nhập user name";
        }
        if(!isset($_POST['password']) ||empty($_POST['password'])) {
            $error[] = "Chưa nhập password";
        }
        /*
         * Nếu mảng error bị rỗng nghĩa là không có lỗi đăng nhập
         */
        if(is_array($error) && empty($error)) {
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            // Để đảm bảo an toàn
            $sqlLogin = "SELECT * FROM user WHERE user_name = ? AND password = ?";

            // Chuẩn bị cho phần SQL
            $stmt = $connection->prepare($sqlLogin);
            // Bind 2biến vào câu lệnh SQL
            $stmt->bind_param("ss", $username, $password);
            //Thực thi câu lệnh SQL
            $stmt->execute();
            //Lấy ra bản ghi
            $res = $stmt->get_result();
            //Chuyển kết quả $res thành mảng
            $row = $res->fetch_array(MYSQLI_ASSOC);

            if(isset($row['id']) && $row['id'] > 0) {
                /*
                 * Nếu tồn tại bản ghi thì sẽ tạo ra SESSION đăng nhập
                 */
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $row['user_name'];
            }else {
                $error[] = "Tài khoản không tồn tại";
            }
        }
    }
    if(is_array($error) && !empty($error)) {
        $error_string = implode('<br>', $error);
        echo "<div class='alert alert-danger'>";
        echo $error_string;
        echo "</div>";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container" style="margin-top: 150px;">
        <div class="row">
            <div class="col-md-12">
                <h1>Đăng nhập người dùng</h1>
                <form name="login" action="" method="post">
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="username" class="form-control" placeholder="Enter user name">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group form-check">
                        <p>
                            <a href="register.php">Sign up</a>
                        </p>
                    </div>
                    <button type="submit" class="btn btn-primary">Log In</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>