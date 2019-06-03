<?php
    include "../database.php";
    include "../connect.php";
    $data = array(
        "id" => "null",
        "title" => "'$_POST[title]'",
        "type_id" => "$_POST[type_id]",
        "content" => "'$_POST[content]'",
        "date" => "now()",
        "date_time" => "now()"
    );
    $result = $database->insert("article",$data);
    echo json_encode($result);