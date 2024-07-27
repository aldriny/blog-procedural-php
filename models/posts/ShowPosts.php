<?php
require_once 'config/DBConnect.php';

function show($limit,$offset){
    $conn = connectDb();
    $query = "SELECT id, title, created_at, SUBSTRING(body,1,100) AS body, image FROM posts LIMIT ? OFFSET ?";
    $stmt = mysqli_prepare($conn,$query);
    
    if (!$stmt){
        error_log("Error Preparing Statement" . mysqli_error($conn));
        return false;
    }
    
    mysqli_stmt_bind_param($stmt,'ii',$limit,$offset);

    if (!mysqli_stmt_execute($stmt)) {
        error_log("Error Executing Statement: " . mysqli_error($conn));
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return false;
    }
    
    mysqli_stmt_bind_result($stmt,$id,$title,$created_at,$body, $image);

    $posts = [];
    while(mysqli_stmt_fetch($stmt)){
        $posts[] = [
            'id' => $id,
            'title' => $title,
            'created_at' => formatDate($created_at),
            'body' => $body,
            'image' => $image
        ];
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $posts;
    
}

function formatDate($date) {
    $dateTime = new DateTime($date);
    return $dateTime->format('F j, Y');
}

function getTotalPosts(){
    $conn = connectDb();
    $query = "SELECT count(id) as total FROM posts";
    $stmt = mysqli_prepare($conn,$query);
    
    if (!$stmt){
        error_log("Error Preparing Statement" . mysqli_error($conn));
        return false;
    }
    if (!mysqli_stmt_execute($stmt)) {
        error_log("Error Executing Statement: " . mysqli_error($conn));
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return false;
    }
    
    mysqli_stmt_bind_result($stmt,$total);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $total;
}