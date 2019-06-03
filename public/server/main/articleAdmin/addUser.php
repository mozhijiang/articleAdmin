<?php
    include "../../database.php";
    include "../../connect.php";
    $result = $database->select("id","user","where name = '$_POST[name]'");
    $data = array(
        "name" => "'$_POST[name]'",
        "password" => "'$_POST[password]'",
        "img" => "null",
        "type" => "'user'"
    );
    echo json_encode($database->insert("user",$data));