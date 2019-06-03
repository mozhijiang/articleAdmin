<?php
    include "../../database.php";
    include "../../connect.php";
    $id = $_POST['id'];
    echo json_encode($database->update("comments","set state = 1 where id = $id"));