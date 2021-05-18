<?php
$errname = $errid = $errpass = '';
if(isset($_POST['register'])) {
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $password = $_POST['password'];
    $admin_phone = $_POST['admin_phone'];
    $admin_address = $_POST['admin_address'];

    if(empty($admin_name)){
        $errname .= "Name required";
    } 
    if(empty($admin_email)){
        $errid .= "ID required";
    }
    if(empty($password)){
        $errpass .= "Password required";
    }
    $conn = mysqli_connect('localhost', 'root', '', 'admin');

    if ($admin_email != '') {
        $sql= "SELECT * FROM info WHERE admin_email='$admin_email'";
        $search = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($search);

        if($rows > 0) {
           $errid .= "Admin id already exists";
        } else {
            $sql = "INSERT INTO info (admin_name, admin_email , password, admin_phone, admin_address) VALUES ('$admin_name', '$admin_email', '$password', '$admin_phone', '$admin_address')";
            $result = mysqli_query($conn, $sql);
            if($result == true){
                echo "Registered Sucessfully";
            } else {
                echo "Unable to register";
            }
        }
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
    <title>Registration</title>
</head>
<body>
<div class=container>
    <h2>Admin Registration</h2>
    <form action="" method="POST">
    Admin Full Name :  <input type="text" name="admin_name"><span style ="color:red"><?php echo $errname ?>*</span><br><br>
    Admin ID : &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<input type="email" name=admin_email><span style ="color:red"><?php echo $errid ?>*</span><br><br>
    Admin Password : <input type="password" name="password" onkeydown="return AvoidSpace(event)"><span style ="color:red"><?php echo $errpass ?>*</span><br><br>
    Admin Phone No. : <input type="number" name="admin_phone"> <br><br>
    Admin Address : <input type="text" name="admin_address"> <br><br>
    
    <button type="submit" name="register" class="btn btn-primary">Register</button>
    <a href="login.php" class="btn-sm btn-secondary btn-lg active" role="button" aria-pressed="true">Go to login page</a>
    </form>
</div>
<script>
function AvoidSpace(event) {
    var k = event ? event.which : window.event.keyCode;
    if (k == 32){ 
     alert("No spaces are allowed"); 
    return false;
    }
}
</script>
</body>
</html>