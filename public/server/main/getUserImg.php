<?php
    include "../database.php";
    include "../connect.php";
    header("Content-type: image/jpeg");
    $id = $_POST["userId"];
    $where = "where id = $id";
    $result = $database->select("img","user",$where);
    $img = base64_decode($result->fetch_row()[0]);
    if($img == NULL){
        $result = $database->select("img","default_img","");
        $img = base64_decode($result->fetch_row()[0]);
    }
    echo $img;