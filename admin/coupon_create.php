<?php
if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
$conn = mysqli_connect('localhost', 'root', '', 'admin');
$errcode = $code = $value = $min_value = $validity = $update = "";

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $sql1 = "SELECT * FROM coupon WHERE id=$id";
    $result = mysqli_query($conn, $sql1);
    if(! empty($result)==1){
        $rows = mysqli_fetch_array($result);
        $code = $rows['code'];
        $ctype = $rows['ctype'];
        $value = $rows['value'];
        $min_value = $rows['min_value'];
      //  $validity = $rows['validity'];
    }
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $code = $_POST['code'];
    $ctype = $_POST['ctype'];
    $value =$_POST['value'];
    $min_value = $_POST['min_value'];
  //  $validity = $_POST['validity'];
      if(empty($code)){
        $errcode .= "Code cannot be empty";
      } else {
          $sql2 = "UPDATE coupon SET code='$code', ctype='$ctype', value='$value', min_value=$min_value WHERE id=$id";
          $result = mysqli_query($conn, $sql2);
          echo "Record updated successfully";
          header('location: coupon_show.php');
        }
}



if(isset($_POST['add'])){
  $code = $_POST['code'];
  $ctype = $_POST['ctype'];
  $value = $_POST['value'];
  $min_value = $_POST['min_value'];
  $validity = $_POST['validity'];

  if(!empty($code)){
    $sql = "SELECT code FROM coupon where code='$code'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($res);
    if($row > 0) {
     $errcode .= "Code already exists. Please try other code <br>";
       } else {
          $sql3 = "INSERT INTO coupon (code, ctype, value, min_value, validity) VALUES('$code', '$ctype', '$value', '$min_value', '$validity')";
          $add = mysqli_query($conn, $sql3);
          echo "Coupon Added";
         }
    }
}

define('title', 'Coupons');
include 'header.php';
?>

<div class="container">

<?php if(isset($_SESSION['admin_email'])) {  ?>

<form action="" method="POST" class="form-row">
<div class="form-group">
<input type="hidden" name="id" value="<?php echo $id; ?>">
Coupon Code: <input type="text" name="code" class="form-control" value="<?php echo $code;?>" required> <span style="color:red"> <?php echo $errcode; ?></span>
Coupon Type: <input type="radio" name="ctype" value="percentage" required> Percentage
             <input type="radio" name="ctype" value="rs" required> Rs.  <br>
Coupon Value: <input type="number" name="value" class="form-control" value="<?php echo $value; ?>" required>
Cart Minimum Value: <input type="number" name="min_value"class="form-control" value="<?php echo $min_value;?>" required>

    <?php    if($update == true):    ?>
<button type="submit"class="btn btn-info" name="update">Update</button>
    <?php else:  ?>
Validity Date: <input type="date" name="validity" class="form-control" value="<?php echo $validity; ?>" required="required">

<button type="submit" name="add" class="btn btn-primary mb-2">
<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 
<span>ADD</button></span>
    <?php endif;?>
</form>
</div>
<?php 
} else {
    echo "<script>alert('User Doesnot exist');</script>";
    echo "Invalid Session, try <a href=login.php> logging in</a> here "; 
} 
?>
</div>
</body>
</html>