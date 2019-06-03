<?php
    include "../../database.php";
    include "../../connect.php";
    $result = $database->select("id,name,password,type","user","");
    $users = array();
    while($user = $result->fetch_assoc()){
        array_push($users,$user);
    }
    echo json_encode($users);