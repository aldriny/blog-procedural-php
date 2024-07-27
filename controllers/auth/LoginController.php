<?php
session_start();
require_once '../../models/auth/Login.php';
require_once '../../inc/errorhandler.php';

function filterInput($input){
    return trim(htmlspecialchars($input));
}

function isValidEmail($email){
    return filter_var($email,FILTER_VALIDATE_EMAIL);
}
function isValidPassword($password){
    $passwordRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/";
    return preg_match($passwordRegex,$password);
}


function login($email,$password){
    $errors = [];
    $redirectTo = "Login.php";
    
    if (!isValidEmail($email)) {
        $errors[] = "Invalid email format";
    }
    if (!isValidPassword($password)) {
        $errors[] = "Invalid Password";
    }
    if (!empty($errors)) {
        handleErrors($errors,$redirectTo);
    }
    $user = loginUser($email,$password);
    
    if (!$user) {
        $errors[] = "Invalid email or password";
        handleErrors($errors,$redirectTo);
    }
    
    $_SESSION['user'] = $user;
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['success'] = ['User logged In Successfully'];
    header("location: ../../index.php");
    exit();
}



if (isset($_POST['submit'])) {
    $email = filterInput($_POST['email']);
    $password = filterInput($_POST['password']);
    login($email,$password);
}