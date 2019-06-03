<?php
    include "../../database.php";
    include "../../connect.php";
    $id = $_POST["id"];
    $articles = $database->select("id","article","where type_id = $id");
    while($article = $articles -> fetch_assoc()){
        $database->del("comments","article_id = $article[id]");
        $database->del("article","id = $article[id]");
    }
    $database->del("articletype","id = $id");