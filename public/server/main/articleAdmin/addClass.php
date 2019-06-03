<?php
    include "../../database.php";
    include "../../connect.php";
    $className = $_POST["className"];
    $data = array(
        "id" => "null",
        "name" => "'$className'",
        "browse" => "0",
        "star" => "0"
    );
    $result = $database->insert("articletype",$data);
    if($result){
        echo json_encode(true);
    }else{
        echo json_encode(false);
    }