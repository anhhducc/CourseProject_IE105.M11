<?php

    session_start();

    // Initialize a database connection
    $root_conn = mysqli_connect("localhost", "root", "thanhnhan", "ie105");

    if(!$root_conn){
        echo "<h3 class='container bg-dark p-3 text-center text-warning rounded-lg mt-5'>Not able to establish Database Connection<h3>";
    }

    // Sign in
    if(isset($_REQUEST['signin'])) {
        $username = mysqli_real_escape_string($root_conn, $_REQUEST['username']);
        $password = mysqli_real_escape_string($root_conn, $_REQUEST['password']);

        if ($username === "admin" && $password === "admin") {
            $_SESSION['isAdmin'] = true;
            header("Location: home.php");
            exit();
        }
        else {
            $sql = "SELECT * FROM Users WHERE username='$username' AND password='$password'";
            $query = mysqli_query($root_conn, $sql);
            $count = mysqli_num_rows($query);

            if ($count == 1) {
                $_SESSION['isAdmin'] = false;
                header("Location: home.php");
                exit();
            }
            else {
                echo "<h3 class='container bg-dark p-3 text-center text-warning rounded-lg mt-5'>Failed to sign in<h3>";
            } 
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>Blog using PHP & MySQL</title>
</head>
<body>
    <nav class="topnav">
        <a class="active" href="index.php">Home</a>
        <a href="signin.php">Sign in</a>
        <a href="signup.php">Sign up</a>
    </nav>

    <form method="POST" class="form-signin">
      <img class="mb-4" src="n-logo.png" alt="logo" >
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputUsername" class="sr-only">Username</label>
      <input type="text" id="inputUsername" class="form-control" placeholder="Username" name="username" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="signin">Sign in</button>
    </form>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script src="main.js"></script>
</body>
</html>
