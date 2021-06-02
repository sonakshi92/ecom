<?php
//session_start();
require ('../config/config.php');
require ('functions.inc.php');
//$conn = mysqli_connect('localhost', 'root', '', 'admin');
if(isset($_POST['login'])){
    $admin_email = get_safe_value($conn, $_POST['admin_email']);
    $password = get_safe_value($conn, $_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM info WHERE admin_email='$admin_email' AND password='$password'");
    $numrows = mysqli_num_rows($query);
    
    if(mysqli_num_rows($query)>0){
        echo "login sucessful";
		$_SESSION['ADMIN_LOGIN']='yes';
        $_SESSION['admin_email'] = $admin_email;
        header("location: profile.php");
    } else {
        echo "Email or Password is invalid";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Login</title>
</head>
<body>
<div class=container>
<h1 style="background-color:red"> Welcome</h1>
    <h2>Admin Login</h2>
    <form action="" method="POST">
    Admin ID : <input type="email" name="admin_email" autofocus required><br><br>
    Password : <input type="password" name="password" required><br><br>
    <button type="submit" name="login" class="btn btn-primary">Login</button>
    <a href="register.php" class="btn-sm btn-secondary btn-lg active">Go to registration page</a>

    </form>
</body>
</html>