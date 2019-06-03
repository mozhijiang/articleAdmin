<?php
    include "../../../database.php";
    include "../../../connect.php";
    $data = Array(
        "id" => "null",
        "article_id" => "$_POST[article_id]",
        "text" => "'$_POST[text]'",
        "user_id" => "$_POST[user_id]",
        "date" => "now()",
        "state" => "0",
        "date_time" => "now()"
    );
    echo json_encode($database->insert("comments",$data));