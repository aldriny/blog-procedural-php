<?php
session_start();
require_once '../../models/auth/Register.php';
require_once '../../inc/errorhandler.php';

function filterInput($input){
    return trim(htmlspecialchars($input));
}

function isValidInputs($name, $email, $password, $phone){
    return !empty($name) && !empty($email) && !empty($password) && !empty($phone);
}

function isValidName($name){
    $nameRegex = "/^([A-Za-z\p{L}\s'\-]{2,100})$/u";        
    return preg_match($nameRegex,$name);
}
function isValidEmail($email){
    return filter_var($email,FILTER_VALIDATE_EMAIL);
}
function isValidPassword($password){
    $passwordRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/";
    return preg_match($passwordRegex,$password);
}

function isValidPhone($phone){
    $phoneRegex = '/^(\+?\d{1,4}[\s-]?)?(\(?\d{1,4}\)?[\s-]?)?[\d\s-]{7,15}$/';
    return preg_match($phoneRegex,$phone);
}

function signUp($name, $email, $password, $phone){
    $errors = [];
    $redirectTo = "register.php";

    
    if (!isValidInputs($name, $email,$password,$phone)) {
        $errors[] = "All fields are required";
    }
    
    if (!isValidName($name)){
        $errors[] = "Invalid name";
    }
    
    if (!isValidEmail($email)){
        $errors[] = "Invalid email";
    }
    if(checkEmailExists($email)){
        $errors[] = "Email already exists";
    }
    
    if (!isValidPassword($password)){
        $errors[] = "Invalid password";
    }
    
    if (!isValidPhone($phone)){
        $errors[] = "Invalid phone number";
    }
    if (!empty($errors)){
        handleErrors($errors,$redirectTo);
    }
    $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
    
    if(register($name, $email, $hashedPassword, $phone)){
        $_SESSION['success'] = "Registration successful";
        header("location: ../../Login.php");
        exit();
    }
    else{
        $errors[] = "An error occurred while registering";
        handleErrors($errors,$redirectTo);
    }
}

if (isset($_POST['submit'])) {
    $name = filterInput($_POST['name']);
    $email = filterInput($_POST['email']);
    $password = filterInput($_POST['password']);
    $phone = filterInput($_POST['phone']);

    signUp($name, $email, $password, $phone);
}