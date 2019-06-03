<?php
    include "../../database.php";
    include "../../connect.php";
    $where = "";
    if(isset($_POST['keyword'])) $where = "where title LIKE '%$_POST[keyword]%'";
    $result = $database->select(
        "*",
        "article",
        "$where order by date_time desc"
    );
    $data = array();
    while($arr = $result->fetch_assoc()){
        $type = $database->select("name","articletype","where id = $arr[type_id]");
        $arr['type'] = $type->fetch_row()[0];
        array_push($data,$arr);
    }
    echo json_encode($data);