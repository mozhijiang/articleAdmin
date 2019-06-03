<?php
    include "../../database.php";
    include "../../connect.php";
    $id = $_POST['id'];
    echo json_encode($database->del("comments","id = $id"));