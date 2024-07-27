<?php
require_once 'config/DBConnect.php';
function show($id){
    $conn = connectDb();
    $query = "SELECT posts.id AS post_id, users.id AS user_id, users.name, posts.title, posts.body, posts.created_at, posts.image FROM posts JOIN users
    ON users.id = posts.user_id
    WHERE posts.id = ?";
    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt){
        error_log("Error Preparing Statement" . mysqli_error($conn));
        return false;
    }
    
    mysqli_stmt_bind_param($stmt,'i',$id);

    if (!mysqli_stmt_execute($stmt)) {
        error_log("Error Executing Statement: " . mysqli_error($conn));
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return false;
    }
    
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) == 0){
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return false;
    }
    $post = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $post;
}