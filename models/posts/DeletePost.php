<?php
require_once '../../config/DBConnect.php';
function delete($id){
    $conn = connectDb();
    // get image name before deleting the post to delete the image file later on
    $query = "SELECT image FROM posts WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        error_log("Error Preparing Statement" . mysqli_error($conn));
        return false;
    }
    mysqli_stmt_bind_param($stmt,'i',$id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,$image);
    if (!mysqli_stmt_fetch($stmt)){
        error_log("Error fetching image name" . mysqli_error($conn));
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return false;
    }
    mysqli_stmt_close($stmt);


    // delete post from the database
    $query = "DELETE FROM posts WHERE id =?";
    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        error_log("Error Preparing Statement" . mysqli_error($conn));
        return false;
    }
    mysqli_stmt_bind_param($stmt,'i',$id);

    if(!mysqli_stmt_execute($stmt)){
        error_log("Error executing Statement" . mysqli_error($conn));
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return false;
    }

    $success = mysqli_stmt_affected_rows($stmt) > 0;

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    
    // delete image file if post is successfully deleted from the database
    if ($success){
        $filePath = "../../assets/images/$image";
        if (file_exists($filePath)){
            unlink($filePath);
        }
    }
    return $success;

}