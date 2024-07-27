<?php
require_once 'models/posts/ShowPosts.php';

function showPosts(){
    $limit = 6;
    $page = isset($_GET['page'])? $_GET['page'] : 1;
    $offset = ($page - 1) * $limit;
    $posts = show($limit,$offset);
    $totalPages = getTotalPages($limit);

    return [$posts,$page,$totalPages];
}


function getTotalPages($limit){
    $totalPosts = getTotalPosts();
    return ceil($totalPosts / $limit);
}