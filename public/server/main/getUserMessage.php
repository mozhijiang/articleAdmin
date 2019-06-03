<?php
    include "../database.php";
    include "../connect.php";
    $id = $_POST["userId"];
    $where = "where id = $id";
    $result = $database->select("name,password,type","user",$where);
    if($result->num_rows){
        echo json_encode($result->fetch_assoc());
    }else{
        echo json_encode(null);
    }