<?php
require_once '../../config/DBConnect.php';

function store($userId,$title,$body,$image){
    $conn = connectDb();
    $query = "INSERT INTO posts (user_id,title,body,image) VALUES (?,?,?,?)";
    $stmt = mysqli_prepare($conn,$query);
    
    if (!$stmt){
        error_log("Error Preparing Statement" . mysqli_error($conn));
        return false;
    }
    
    mysqli_stmt_bind_param($stmt,"isss",$userId,$title,$body,$image);
    $success = mysqli_stmt_execute($stmt);
    if (!$success){
        error_log("Error Executing Statement" . mysqli_error($conn));
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return $success;
}