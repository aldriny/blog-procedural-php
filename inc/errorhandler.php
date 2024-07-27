<?php

function handleErrors($errors,$redirectTo,$postId = 0){
    $_SESSION['errors'] = $errors;
    $errorString = implode("&",array_map(function ($error){
        return "postError[]=" . urlencode($error);
    },$errors));
    header("location: ../../$redirectTo?id=$postId&" . $errorString);
    exit();
}