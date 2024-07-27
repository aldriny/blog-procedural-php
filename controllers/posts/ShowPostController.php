<?php
session_start();
require_once 'models/posts/ShowPost.php';

function showPost(){
    if (!isset($_GET['id'])){
        $_SESSION['errors'] = ['Post not found'];
        header("location:index.php");
        exit();
    }else{
        return show($_GET['id']);
    }
}