<?php
    include "../../database.php";
    include "../../connect.php";
    $id = $_POST['id'];
    $result = $database->select("*","article","where id = $id");
    echo json_encode($result->fetch_assoc());