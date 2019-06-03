<?php
    include "../../../database.php";
    include "../../../connect.php";
    $result = $database->select("*","comments",
        "where article_id = $_POST[id] and state = 1 order by date_time desc"
    );
    $comments = Array();
    while($comment = $result->fetch_assoc()){
        array_push($comments,$comment);
    }
    echo json_encode($comments);