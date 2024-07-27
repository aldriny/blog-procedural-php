<?php
session_start();
require_once '../../models/posts/DeletePost.php';
require_once '../../inc/errorhandler.php';
require_once '../../inc/authourize.php';

authourizedUser();

function deletePost($postId){
    if (delete($postId)) {
        $_SESSION['success'] = ['Post deleted successfully'];
        header("Location: ../../index.php");
        exit();            
    }
    else{
        $errors[] = 'Failed to delete post';
        $redirectTo = "viewPost.php";
        handleErrors($errors,$redirectTo,$postId);
    }

}

if (isset($_POST['submit']) && isset($_GET['id'])){
    $postId = intval($_GET['id']);
    deletePost($postId);
}


