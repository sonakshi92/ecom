<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'admin');
$errid = $errpassword ='';
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email' AND password='$password'");
    $numrows = mysqli_num_rows($query);
    
    if(mysqli_num_rows($query)>0){
        echo "login sucessful";
        $_SESSION['email'] = $email;
        header("location: userprofile.php");
    } else {
        echo "Email or Password is invalid";
    }
}

?>

<?php
define('title', 'Users Login');
include 'header.php'; ?>


<div class=container>

    <h2> User Login</h2>
    <form action="" method="POST">
    User Email ID : <input type="email" name="email" autofocus><br><br>
    Password : <input type="password" name="password"><br><br>
    <button type="submit" name="login" class="btn btn-primary">Login</button>
    <a href="usercreation.php" class="btn-sm btn-secondary btn-lg active">Go to User Creation page</a>
    </form>
</body>
</html>