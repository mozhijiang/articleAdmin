<?php
    include "../../database.php";
    include "../../connect.php";
    $keyword = $_POST['keyword'];
    $select = $_POST['select'];
    $where = "";
    if($keyword !== ""){
        $where = "where text like '%$keyword%'";
        if($select !== "")
            $where .= " and state = $select";
    }else{
        if($select !== "")
            $where = "where state = $select";
    }
    $where .= " order by date_time desc";
    $result = $database->select("*","comments",$where);
    $comments = array();
    while($comment = $result->fetch_assoc()){
        $user_name = $database->select("name","user","where id = $comment[user_id]");
        $comment['user_name'] = $user_name->fetch_assoc()["name"];
        $article_title = $database->select("title","article","where id = $comment[article_id]");
        $comment['article_title'] = $article_title->fetch_assoc()["title"];
        $comment['state'] =  (bool)$comment['state'];
        array_push($comments,$comment);
    }
    echo json_encode($comments);