<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php
    include_once "config.php";
    if(isset($_POST) && !empty($_POST)) {
        $error = array();
        if(!isset($_POST['username']) || empty($_POST['username'])) {
            $error[] = "User name không hợp lệ";
        }
        if(!isset($_POST['password']) || empty($_POST['password'])) {
            $error[] = "Password không hợp lệ";
        }
        if(!isset($_POST['confirm_password']) || empty($_POST['confirm_password'])) {
            $error[] = "Confirm Password không hợp lệ";
        }

        if($_POST['password'] !== $_POST['confirm_password']) {
            $error[] = "Password không trùng khớp";
        }

        if(empty($error)) {
            /*
             * Nếu không có lỗi thì thực thi câu lệnh insert vào CSDL
             */
            $username = $_POST['username'];
            $password = md5($_POST['password']); //md5() : mã hóa 1 chiều
            $created_at = date("y-m-d H:i:s");
            /*
             * Kiểm tra đã tồn tại tài khoản đăng ký chưa
             */
            // Để đảm bảo an toàn
            $sqlCheck = "SELECT * FROM user WHERE user_name = ? AND password = ?";

            // Chuẩn bị cho phần SQL
            $stmt = $connection->prepare($sqlCheck);
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
                 * Nếu tồn tại bản ghi thì sẽ báo lỗi
                 */
                $error[] = "Tài khoản đã tồn tại";
            }else {
                // Để đảm bảo an toàn khi insert dữ liệu thì dùng VALUE(?,?,?) thay vì truyền các biến vào VALUE
                $sqlInsert = "INSERT INTO user (user_name,password,created_at) VALUE (?,?,?)";

                // Chuẩn bị cho phần SQL
                $stmt = $connection->prepare($sqlInsert);
                // Bind 3 biến vào câu lệnh SQL 'sss': Định dạng của 3 biến bind vào là String-String-String
                $stmt->bind_param("sss", $username, $password, $created_at);

                $stmt->execute();
                $stmt->close();
                echo "<div class='alert alert-success'>";
                echo "Đăng ký người dùng mới thành công";
                echo "<br>Hãy <a href='login.php'>Đăng nhập</a> ngay lập tức";
                echo "</div>";
            }

        }
        if(is_array($error) && !empty($error)) {
            $error_string = implode('<br>', $error);
            echo "<div class='alert alert-danger'>";
            echo $error_string;
            echo "</div>";
        }
    }
?>
<div class="container" style="margin-top: 150px;">
    <div class="row">
        <div class="col-md-12">
            <h1>Đăng ký người dùng</h1>
            <form name="register" action="" method="post">
                <div class="form-group">
                    <label>User Name</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter user name">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
                </div>
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>