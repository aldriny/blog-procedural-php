<?php
session_start();
unset($_SESSION['user']);
unset($_SESSION['user_id']);
$_SESSION['success'] = ['User logged out Successfully'];

header("location: ../../index.php");
exit();