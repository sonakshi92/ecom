<?php
if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
$conn = mysqli_connect('localhost', 'root', '', 'admin');
$errbrand = $brand = $description = " ";
$update = false;
if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }

$conn = mysqli_connect('localhost', 'root', '', 'admin');

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $sql1 = "SELECT * FROM brands WHERE id=$id";
    $result = mysqli_query($conn, $sql1);
    if(! empty($result)==1){
        $rows = mysqli_fetch_array($result);
        $brand = $rows['brand'];
        $description = $rows['description'];
    }
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $brand = $_POST['brand'];
    $description = $_POST['description'];
      if(empty($brand)){
        $errbrand .= "Brand cannot be empty";
      } else {
          $sql2 = "UPDATE brands SET brand='$brand', description='$description' WHERE id=$id";
          $result = mysqli_query($conn, $sql2);
          echo "Record updated successfully";
        }
        header('location: brand_list.php');     
}


if(isset($_POST['add'])){
    $brand = $_POST['brand'];
    $description = $_POST['description'];
    if($brand != ''){
        $sql = "SELECT * FROM brands where brand='$brand'";
        $search = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($search);
    
        if($rows > 0) {
            $errbrand .= "Brand Already Exists";
        } else{
            $sql3 = "INSERT INTO brands (brand, description) VALUES('$brand', '$description')";
            $add = mysqli_query($conn, $sql3);
            echo "Brand Added";
          header('location: brand_list.php');

        }
    }
    
}

define('title', 'Add New Brand');
include 'header.php'; 
?>


<div class="container">
<?php if(isset($_SESSION['admin_email'])) {  ?>

<form action="" method="POST">
<input type="hidden" name="id" value="<?php echo $id; ?>" readonly>
<b>Brand Name : </b><input type="text" name="brand" value="<?php echo $brand; ?>"><span style="color:red"><?php echo $errbrand; ?></span><br><br>
<b>Description :</b><br> <textarea name="description" cols="30" rows="10"><?php echo $description; ?></textarea><br>

<?php    if($update == true):    ?>

<button type="submit" name="update" class="btn btn-primary" >Update</button>
<?php else:  ?>

<button type="submit" name="add" class="btn btn-primary a-btn-slide-text">
<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
<span>ADD</button></span>
<?php endif;?>

</form>
<?php 
} else {
    echo "<script>alert('User Doesnot exist');</script>";
    echo "Invalid Session, try <a href=login.php> logging in</a> here "; 
} 
?>
</div>
</body>
</html>