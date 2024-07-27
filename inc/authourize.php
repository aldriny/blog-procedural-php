<?php

function authourizedUser(){
    if (!isset($_SESSION['user_id']) ||  !$_SESSION['user_id']) {
        if (basename($_SERVER['PHP_SELF']) !== 'Login.php' && basename($_SERVER['PHP_SELF']) !== 'register.php') {
            $basePath = getPath();
            $loginPath = $basePath . '/Login.php';
            
            header('Location: ' . $loginPath);
            exit();
        }
    }
    else{
        if (basename($_SERVER['PHP_SELF']) === 'login.php' || basename($_SERVER['PHP_SELF']) === 'register.php') {
        $basePath = getPath();
        $homePath = $basePath . '/index.php';
        header('Location: ' . $homePath);
        exit();        
        }
    }
}

function getPath(){
    $currentFile = $_SERVER['PHP_SELF'];
    $basePath = dirname($currentFile);
    return $basePath;
}