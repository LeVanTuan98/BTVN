<?php

include_once "../ajax_sql/database.php";

$current = (int)$_POST['current'];
$limit = (int)$_POST['limit'];
$db = new Database();
$connection = $db::$connection;
$sql = "SELECT * FROM posts LIMIT $current,$limit"; // số bản ghi lấy ra

$result = $connection->query($sql);
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
//    echo "<pre>";
//    print_r($data);
//    echo "</pre>";
$html = "";
if(!empty($data)) :
    foreach ($data as $post) :
        $html.= '<div class="col-md-4">
            <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="'.$post["post_image"].'"  style="height: 225px; width: 100%; display: block;">
                <h2>'.$post["post_name"].'</h2>
                <div class="card-body">
                    <p class="card-text">'.$post["post_content"].'</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                        </div>
                        <small class="text-muted">9 mins</small>
                    </div>
                </div>
            </div>
        </div>';
    endforeach;
endif;
$response  = array();
$response['success'] = 1;
$response['html'] = $html;
echo json_encode($response);
exit;