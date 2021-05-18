<?php
define('title', 'Dashboard');
include 'header.php'; ?>

<div style="background-color:lightpink" class="container">
<div class="container">
<h2 style=color:red> Total Users:
<?php
$conn = mysqli_connect('localhost', 'root', '', 'admin');
$sql = mysqli_query($conn, "SELECT * FROM user");
$row = mysqli_num_rows($sql);
echo $row;
?></h2>
</div>

<div>
<h2 style=color:blue> No of Products:
<?php
$sql = mysqli_query($conn, "SELECT * FROM products");
$row = mysqli_num_rows($sql);
echo $row;
?></h2>
</div>


<div>
<h2 style=color:yellow> No of Categories:
<?php
$sql2 = mysqli_query($conn, "SELECT * FROM categories");
$row = mysqli_num_rows($sql2);
echo $row;
?></h2>
</div>

<div>
<h2 style=color:green> Sales:
<?php

?></h2>
</div>

<div>
<h2 style=color:green> Purchases:
<?php

?></h2>
</div>
</body>
</html>