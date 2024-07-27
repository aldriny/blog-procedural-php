<?php
session_start();
require_once '../../models/posts/UpdatePost.php';
require_once '../../inc/errorhandler.php';
require_once '../../inc/authourize.php';

authourizedUser();


function filterInput($input){
    return trim(htmlspecialchars($input));
}

function isValidInputs($title, $body){
    return !empty($title) && !empty($body);
}   

function isValidTitle($title){
    $titleRegex = "/^([A-Za-z\p{L}\d\s'\-]{2,20})$/u";
    return preg_match($titleRegex,$title);
}

function isValidBody($body,&$bodyErrors){
    $minLength = 50;
    $maxLength = 1000;
    $bodyLength = strlen($body);
    if($bodyLength < $minLength || $bodyLength > $maxLength){
        $bodyErrors[] = "Description must be at least $minLength characters and max $maxLength characters";
        return false; 
    }
    return true;
}

function isValidImage($ext,$exts,$size,&$imageErrors){
    if(!in_array($ext,$exts)){
        $imageErrors[] = "Invalid Extension";
        return false;
    }
    if($size > 2){
        $imageErrors[] = "Invalid Size";
        return false;        
    }
    return true;
}

function updatePost($postId,$title,$body,$bodyErrors,$image,$imageErrors){
    $errors = [];
    $redirectTo = "editPost.php";

    
    if (!isValidInputs($title,$body)) {
        $errors[] = "All fields are required";
    }
    
    if (!isValidTitle($title)){
        $errors[] = "Invalid Title";
    }
    
    if (!isValidBody($body,$bodyErrors)){
        $errors[] = $bodyErrors[0];
    }
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK){
        $ext = strtolower(pathinfo($image['name'],PATHINFO_EXTENSION));
        $exts = ["png","jpg","jpeg"];
        $size = $image['size'] / (1024*1024);
        if (!isValidImage($ext,$exts,$size,$imageErrors)){
            $errors[] = $imageErrors[0];
        }
    }
    if (!empty($errors)){
        handleErrors($errors,$redirectTo,$postId);
    }
    $newImageName = null;
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK){    
        $newImageName = uniqid() . time() . ".". $ext;
        move_uploaded_file($image['tmp_name'],"../../assets/images/$newImageName");
    }
    else{
        $newImageName = getCurrentImageName($postId);
    }
    

    if (update($postId,$title,$body,$newImageName)) {
        $_SESSION['success'] = ['Post updated successfully'];   
        header("Location: ../../viewPost.php?id=$postId");
        exit();         
    }
    else{
        $errors[] = "Failed to update post";
        handleErrors($errors,$redirectTo,$postId);
    }
}

if (isset($_POST['submit'])) {
    $postId = filterInput($_GET['id']);
    $title = filterInput($_POST['title']);
    $body = filterInput($_POST['body']);
    $image = $_FILES['image'];


    $bodyErrors = [];
    $imageErrors = [];
    
    updatePost($postId,$title,$body,$bodyErrors,$image,$imageErrors);
}