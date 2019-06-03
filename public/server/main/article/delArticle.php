<?php
    include "../../database.php";
    include "../../connect.php";
    $id = $_POST["id"];
    $database->del("comments","article_id = $id");
    $database->del("article","id = $id");