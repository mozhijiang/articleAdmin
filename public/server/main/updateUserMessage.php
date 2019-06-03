<?php
    //header('Access-Control-Allow-Origin : *');
    include "../database.php";
    include "../connect.php";
    $name = $_POST['name'];
    $password = $_POST['password'];
    $id = $_POST['id'];
    $query = "set name = '$name' , password = '$password' ";
    if($_FILES){
        $image = base64_encode(file_get_contents($_FILES["img"]['tmp_name']));
        $query.= ", img = ";
        $query.= "'$image'";
    }
    //UPDATE `user` SET name = '123456', password = '123456' WHERE `user`.`id` = 35
    $query .= "where id = $id";
    echo json_encode($database->update("user",$query));