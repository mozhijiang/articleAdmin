<?php
    include "../database.php";
    include "../connect.php";
    $id = $_POST["userId"];
    $where = "where id = $id";
    $result = $database->select("name","user",$where);
    if($result->num_rows){
        echo json_encode($result->fetch_row()[0]);
    }else{
        echo json_encode(null);
    }