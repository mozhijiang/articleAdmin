<?php
    include "./database.php";
    include "./connect.php";
    $username = $_POST["username"];
    $password = $_POST["password"];
    $where = "where name = '$username' and password = '$password'";
    $result = $database->select("id,type","user",$where);
    if($result->num_rows){
        $user = $result->fetch_assoc();
        $user["id"] = (int)$user["id"];
        echo json_encode($user);
    }else{
        echo json_encode(false);
    }