<?php
//session_start();
$admin_email = $_SESSION['admin_email'];
//$admin_email = $_GET['admin_email'];
//echo'<pre>'; print_r($adminSession); exit;
?>


<?php
define('title', 'Admin Profile');
include 'header.php'; ?>

<h1>Admin Profile</h1>
<table class="table table-hover table-striped">
  <thead class="table-dark">
    <tr>
      <th scope="col"> Name</th>
      <th scope="col">Email ID</th>
      <th scope="col"> Phone No. </th>
    </tr>
  </thead>
<?php
//$conn = mysqli_connect('localhost', 'root', '', 'admin');
$query = mysqli_query($conn, "SELECT * FROM info WHERE admin_email='$admin_email'");

$row = mysqli_fetch_array($query);
?>
    <tr>   
      <td><?php echo $row['admin_name']; ?></td>
      <td><?php echo $row['admin_email']; ?></td>
      <td><?php echo $row['admin_phone']; ?></td>
    </tr>
</table>
</body>
</html>