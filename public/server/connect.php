<?php
$db_conf = array(
    "address" => "localhost",
    "user" => "root",
    "password" => "",
    "database" => "article_admin"
);
$database = new Database(
    $db_conf["address"],
    $db_conf["user"],
    $db_conf["password"],
    $db_conf["database"]
);