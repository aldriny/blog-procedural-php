<?php
require_once '../../config/DBConnect.php';

function register($name,$email,$hashedPassword,$phone){
    
    $conn = connectDb();
    $query = "INSERT INTO users (name,email,password,phone) VALUES (?,?,?,?)";
    $stmt = mysqli_prepare($conn,$query);
    
    if (!$stmt) {
        error_log("Error Preparing Statement" . mysqli_error($conn));
        return false;
    }
    
    mysqli_stmt_bind_param($stmt,"ssss",$name,$email,$hashedPassword,$phone);

    if(!mysqli_stmt_execute($stmt)){
        error_log("Error executing Statement" . mysqli_error($conn));
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return false;
    }
    mysqli_stmt_close($stmt);

    mysqli_close($conn);
    return true;
}

// check if email exist

function checkEmailExists($email){
    $conn = connectDb();
    $query = "SELECT email FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn,$query);

    if (!$stmt) {
        error_log("Error Preparing Statement" . mysqli_error($conn));
        return false;
    }

    mysqli_stmt_bind_param($stmt,"s",$email);

    if(!mysqli_stmt_execute($stmt)){
        error_log("Error executing Statement" . mysqli_error($conn));
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return false;
    }

    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    return mysqli_num_rows($result) > 0;
}