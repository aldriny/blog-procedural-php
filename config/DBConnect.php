<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
function connectDb(){

    $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();

    $serverName = $_ENV['DB_SERVER_NAME'];
    $userName = $_ENV['DB_USER_NAME'];
    $password = $_ENV['DB_PASSWORD'];
    $dbName = $_ENV['DB_NAME'];
    
    // Create connection
    $conn = mysqli_connect($serverName,$userName,$password,$dbName);
    // Check connection
    if (!$conn) {
        die("Connection failed: ". mysqli_connect_error());
    }
    return $conn;    
}
