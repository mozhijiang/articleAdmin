<?php
    include "../../database.php";
    include "../../connect.php";
    $id = $_POST["id"];
    $database->del("comments","user_id = $id");
    $database->del("user","id = $id");