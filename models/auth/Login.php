<?php
require_once '../../config/DBConnect.php';

function loginUser($email,$password){
    $conn = connectDb();
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        error_log("Error Preparing Statement" . mysqli_error($conn));
        return false;
    }
    mysqli_stmt_bind_param($stmt,'s',$email);
    if(!mysqli_stmt_execute($stmt)){
        error_log("Error executing Statement" . mysqli_error($conn));
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return false;
    }
    
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) == 0) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return false;
    }
    $user = mysqli_fetch_assoc($result);
    if (!password_verify($password, $user['password'])) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return false;
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $user;

}