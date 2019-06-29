<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
<?php
    include_once "ajax_sql/database.php";
    $db = new Database();
    $connection = $db::$connection;
    $sql = "SELECT * FROM posts LIMIT 0,21"; // Phân trang

    $result = $connection->query($sql);
    $data = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
//    echo "<pre>";
//    print_r($data);
//    echo "</pre>";
?>
    <div class="container" style="margin-top: 100px;">
        <div class="row album-list">
            <?php if(!empty($data)) :?>
                <?php foreach ($data as $post) : ?>
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" src="<?php echo $post['post_image']; ?>"  style="height: 225px; width: 100%; display: block;">
                            <h2><?php echo $post['post_name']; ?></h2>
                            <div class="card-body">
                                <p class="card-text"><?php echo $post['post_content']; ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                    </div>
                                    <small class="text-muted">9 mins</small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <div style="margin: 10px; text-align: center">
        <button id="load-more" type="button" class="btn btn-sm btn-success">Load more</button>
    </div>

    <!-- Bootstrap core JavaScript
================================================== -->
    <script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#load-more').on("click",function(event) {
                event.preventDefault();// Ngăn thẻ a chuyển hướng sang một trang khác

                var params = {};
                params.current = $(".album-list").children('.col-md-4').length;//Lấy ra số bản ghi hiệ tại
                console.log(params.current);
                // params.type = "product";
                params.limit = 3;// Mỗi lần sẽ lấy ra 3 bản ghi

                $.ajax({
                    url:"http://localhost/BTVN/App_Ajax/ajax/ajax.php",
                    data: params,
                    type:"POST",
                    dataType:"json",
                    beforeSend:function () {
                        alert("Trước khi gửi request bằng ajax")
                    },
                    success:function (data) {
                        alert("ajax trả về thành công");
                        console.log(data);
                        $(".album-list").append(data.html);
                    },
                    error: function (xhr) {
                        alert("Lỗi ajax");
                    },
                    complete: function (xhr,status) {
                        alert("ajax hoàn tất");
                    }
                })


            })
        });

    </script>
</body>
</html>






