<?php
$errname = $erremail = $errpass = $errid = '';
if(isset($_POST['create'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    if(empty($name)){
        $errname .= "Name required";
    }
    if(empty($email)){
        $erremail .= "Email required";
    }
    if(empty($password)){
        $errpass .= "Password required";
    }

    $conn = mysqli_connect('localhost', 'root', '', 'admin');

    if ($email != '') {
        $sql= "SELECT * FROM user WHERE email='$email'";
        $search = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($search);
     // print_r($rows); exit;
        if($rows > 0) {
           $errid .= "User id already exists";
        } else {
            $sql = "INSERT INTO user (name, email , password, phone, address) VALUES ('$name', '$email', '$password', '$phone', '$address')";
            $result = mysqli_query($conn, $sql);
            if($result == true){
                echo "created Sucessfully";
            } else {
                echo "Unable to create";
            }
        }
    }
}
?>

<?php
define('title', 'Create a new User');
include 'header.php'; ?>

<div class=container>
    <h2>Create New User</h2>
    <span style="color:red"><?php echo $errid;?></span>
    <form action="" method="POST">
    User Full Name :  <input type="text" name="name"><span style ="color:red"><?php echo $errname ?>*</span><br><br>
    User Email : &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<input type="email" name=email><span style ="color:red"><?php echo $erremail ?>*</span><br><br>
    User Password : <input type="password" name="password"><span style ="color:red"><?php echo $errpass ?>*</span><br><br>
    User Phone No. : <input type="number" name="phone"> <br><br>
    User Address : <input type="text" name="address"> <br><br>
    
    
    <button type="submit" name="create" class="btn btn-primary">create</button>
    <a href="userlogin.php" class="btn-sm btn-secondary btn-lg active" role="button" aria-pressed="true"> User login page</a>
    </form>
</div>
</body>
</html>