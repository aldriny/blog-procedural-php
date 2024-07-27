<?php
session_start();
require_once '../../models/posts/StorePost.php';
require_once '../../inc/errorhandler.php';
require_once '../../inc/authourize.php';

authourizedUser();
function filterInput($input){
    return trim(htmlspecialchars($input));
}

function isValidInputs($title, $body, $imageExist){
    return !empty($title) && !empty($body) && $imageExist == 0;
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

function storePost($title,$body,$imageExist,$bodyErrors,$imageErrors,$ext,$exts,$size,$tmpName){
    $errors = [];
    $redirectTo = "addPost.php";
    
    if (!isValidInputs($title,$body,$imageExist)) {
        $errors[] = "All fields are required";
    }
    
    if (!isValidTitle($title)){
        $errors[] = "Invalid Title";
    }
    
    if (!isValidBody($body,$bodyErrors)){
        $errors[] = $bodyErrors[0];
    }
    if (!isValidImage($ext,$exts,$size,$imageErrors)){
        $errors[] = $imageErrors[0];
    }
    if (!empty($errors)){
        handleErrors($errors,$redirectTo);
    }
    $newImageName = uniqid() . time() . ".". $ext;
    move_uploaded_file($tmpName,"../../assets/images/$newImageName");
    $userId = $_SESSION['user_id'];

    if (store($userId,$title,$body,$newImageName)) {
        $_SESSION['success'] = ['Post added successfully'];      
        header("Location: ../../index.php");
        exit();      
    }
    else{
        $errors[] = "Failed to add post";
        handleErrors($errors,$redirectTo);
    }
}

if(isset($_POST['submit'])){
    $title = filterInput($_POST['title']);
    $body = filterInput($_POST['body']);
    $image = $_FILES['image'];
    $imageName = $image['name']; 
    $tmpName = $image['tmp_name'];
    $ext = strtolower(pathinfo($imageName,PATHINFO_EXTENSION));
    $exts = ["png","jpg","jpeg"];
    $size = $image['size'] / (1024*1024);
    $imageExist = $image['error'];
    $bodyErrors = [];
    $imageErrors = [];


    storePost($title,$body,$imageExist,$bodyErrors,$imageErrors,$ext,$exts,$size,$tmpName); 

}