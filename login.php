<?php
require 'config/config.php';
$erremail = "";
if(isset($_POST['login'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$query = mysqli_query($conn, "SELECT * FROM user WHERE name='$name' AND email='$email'");

	if(mysqli_num_rows($query) > 0){
		echo "Login Sucessful";
	} else {
		echo "Invalid name or email";
	}
}
if(isset($_POST['signup'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
		if($email != ''){
			$sql = "SELECT * FROM user where email='$email'";
			$search = mysqli_query($conn, $sql);
			$rows = mysqli_num_rows($search);
		
			if($rows > 0) {
				$erremail .= "Email Already Exists";
			} else{
				$sql2 = "INSERT INTO user (name, email, password) VALUES('$name', '$email', '$password')";
				$add = mysqli_query($conn, $sql2);
				echo "Details Added";
			  //header('location: .php');
	
			}
		}		
}
define('title', 'Login | E-Shopper');
include 'header.php';
?>

<section id="form"><!--form-->
		<div class="container">

			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="" method="POST">
							<input type="text" name="name" placeholder="Name" />
							<input type="email" name="email" placeholder="Email Address" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span>
							<button type="submit" name="login" class="btn btn-default">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="" method="POST">
							<input type="text" name="name" placeholder="Name"/>
							<input type="email" name="email" placeholder="Email Address"/>
							<input type="password" name="password" placeholder="Password"/>
							<button type="submit" name="signup" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
<?php include 'footer.php'; ?>
