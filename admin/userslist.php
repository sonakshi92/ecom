<?php
define('title', 'View All users');
include 'header.php'; ?>


<div class="container">


<table class="table table-hover table-striped" id="list">
  <thead class="table-dark">
    <tr>
      <th scope="col">User Name</th>
      <th scope="col">Email ID</th>
      <th scope="col"> Phone No. </th>
      <th scope="col"> Address </th>

    </tr>
  </thead>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'admin');
$query = mysqli_query($conn, "SELECT * FROM user");

while($row = mysqli_fetch_array($query)){
?>
    <tr>   
      <td><?php echo $row['name']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['phone']; ?></td>
      <td><?php echo $row['address']; ?></td>
    </tr>
<?php } ?>
</table>
<script>
$(document).ready( function () {
    $('#list').DataTable();
} );
</script>
</body>
</html>