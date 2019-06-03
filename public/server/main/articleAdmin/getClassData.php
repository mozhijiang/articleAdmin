<?php
    include "../../database.php";
    include "../../connect.php";
    $result = $database->select("*","articletype","");
    $data = array();
    while($arr = $result->fetch_assoc()){
        $count = $database->select(
            "*",
            "article",
            " where type_id = $arr[id]"
        );
        $arr['count'] = $count->num_rows;
        array_push($data,$arr);
    }
    echo json_encode($data);