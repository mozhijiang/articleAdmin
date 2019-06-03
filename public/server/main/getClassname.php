<?php
    include "../database.php";
    include "../connect.php";
    $result = $database->select("id,name","articletype","");  
    $data = array();
    while($arr = $result->fetch_assoc()){
        array_push($data,$arr);
    }
    echo json_encode($data);