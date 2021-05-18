<?php
session_start();
$userSession = $_SESSION['email'];
//$email = $_GET['email'];
//echo'<pre>'; print_r($userSession); exit;
?>

<?php
define('title', 'Users Profile');
include 'header.php'; ?>


<table class="table table-hover table-striped">
  <thead class="table-dark">
    <tr>
      <th scope="col">User Name</th>
      <th scope="col">Email ID</th>
      <th scope="col"> Phone No. </th>
    </tr>
  </thead>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'admin');
$query = mysqli_query($conn, "SELECT * FROM user WHERE email='$userSession'");

$row = mysqli_fetch_array($query);
?>
    <tr>   
      <td><?php echo $row['name']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['phone']; ?></td>

    </tr>
</table>
</body>
</html>