<?php
    session_start();
    require_once 'inc/authourize.php';

    authourizedUser();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            box-sizing: border-box;
        }
        .nav .links a:hover , button:hover{
            background-color:#8000ff ;
        }
        body {
            display: flex;
            flex-direction: column;
            align-content: center;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            height: 100px;
            padding: 20px;
            background-color: #607d8b4a;
        }

        .nav {
            display: flex;
            flex-direction: row;
            align-content: center;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            height: 100px;
            padding: 10px;
            margin: 0;
        }

        .nav .links {
            width: 15%;
            display: flex;
            justify-content: space-around;
        }

        .nav .links a {
            color: white;
            padding: 4px 10px;
            background-color: #03a9f47a;
            text-decoration: none;
            border-radius: 4px;
            transition: all 1s;
        }

        .input {
            outline: none;
            border: none;
            width: 300px;
            height: 45px;
            border-radius: 10px;
            padding: 10px;
        }

        .form {
            width: 430px;
            height: 425px;
            display: flex;
            flex-direction: column;
            align-items: center;
            align-content: center;
            justify-content: space-between;
            background-color: rgba(255, 255, 255, 0.423);
            backdrop-filter: blur(30px);
            padding: 30px;
            -webkit-filter-blur: 10%;
            border-radius: 30px;
        }

        form button {
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            color: white;
            background-color: #03a9f47a;
            transition: all 1s;
        }

        form span a {
            text-decoration: none;
            color: black;
            font-weight: bold;
        }

        .remember {
            width: 135px;
            height: 32px;
            display: flex;
            flex-direction: row;
            align-content: center;
            justify-content: space-around;
            align-items: center;
        }
        .wrong{
            color: red;
        }
    </style>
</head>

<body>
    <div class="nav">
        <div class="links">
            <a href="register.php">Register</a>
            <a href="index.php">Home</a>
        </div>
    </div>
    <div>
    <?php
    if (isset($_SESSION['errors'])) {
      foreach ($_SESSION['errors'] as $error) {
        echo "<div class='alert alert-danger'>$error</div>";
      }
      unset($_SESSION['errors']);
    }
    if (isset($_SESSION['success'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
      unset($_SESSION['success']);
    }
    ?>

        <form class="form" action="controllers/auth/LoginController.php" method="post">
            
            <h3>Login Here</h3>
            <input placeholder="Enter Email" class="input" type="email" name="email" id=""value="">
            <input class="input" placeholder="Enter Password" type="password" name="password" id="">
            <button type="submit" name="submit">Login</button>
           
            

        </form>
    </div>
</body>

</html>