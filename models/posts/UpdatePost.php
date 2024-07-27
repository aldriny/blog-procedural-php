<?php
require_once '../../config/DBConnect.php';

function update($postId,$title,$body,$image){
    $conn = connectDb();
    $query = "UPDATE posts SET title = ?, body = ?, image = ? WHERE id = ?";

    $stmt = mysqli_prepare($conn,$query);
    
    if (!$stmt){
        error_log("Error Preparing Statement" . mysqli_error($conn));
        return false;
    }
    
    mysqli_stmt_bind_param($stmt,"sssi",$title,$body,$image,$postId);
    $success = mysqli_stmt_execute($stmt);
    
    if (!$success){
        error_log("Error executing Statement: ". mysqli_error($conn));
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $success;
}

function getCurrentImageName($postId){
    $conn = connectDb();
    $query = "SELECT image FROM posts WHERE id =?";
    $stmt = mysqli_prepare($conn,$query);
    
    if (!$stmt){
        die("Error Preparing Statement: ". mysqli_error($conn));
    }
    
    mysqli_stmt_bind_param($stmt,'i',$postId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,$imageName);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $imageName;
    
}