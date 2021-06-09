<?php
//if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }

define('title', 'Add New Product');
include 'header.php'; 
//$conn = mysqli_connect('localhost', 'root', '', 'admin');
$product = $errproduct = $errsku = $image = "";

if(isset($_POST['add'])){
  $product = get_safe_value($conn, $_POST['product']);
  $sku = get_safe_value($conn, $_POST['sku']);
  $category = get_safe_value($conn, $_POST['category']);
  $brand = get_safe_value($conn, $_POST['brand']);
  $file = $_FILES['image'];
  $short_description = get_safe_value($conn, $_POST['short_description']);
  $description = get_safe_value($conn, $_POST['description']);
  $quantity = get_safe_value($conn, $_POST['quantity']);
  $purchase_price = get_safe_value($conn, $_POST['purchase_price']);
  $mrp = get_safe_value($conn, $_POST['mrp']);
  //$status = get_safe_value($conn, $_POST['status']);
  
 // print_r($file);
  $filename = $file['name'];
  $filepath = $file['tmp_name'];
 // $fileerror = $file['error'];

 // if($fileerror == 0){
    $image = 'images/shop/'.$filename;
  //  echo "$destfile";
    move_uploaded_file($filepath, $image);
 // }

  if(empty($product && $sku)){
    $errproduct .= "Please enter product name and SKU <br>";
  }

  if(!empty($sku)){
    $sql = "SELECT sku FROM products where sku='$sku'";
    $search = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($search);
    if($row > 0) {
     $errsku .= "SKU already exists. Please try other sku <br>";
    }
  else{
    if($product != ''){
       $sql = "SELECT product FROM products where product='$product'";
       $search = mysqli_query($conn, $sql);
       $rows = mysqli_num_rows($search);
       if($rows > 0) {
        $errproduct .= "Product already available <br>";
       } else {
          $sql3 = "INSERT INTO products (product, sku, category, brand, image, short_description, description, quantity, purchase_price, mrp, status, qty) VALUES('$product', '$sku', '$category', '$brand', '$image', '$short_description', '$description', '$quantity', '$purchase_price', '$mrp', '1', '1')";
          $add = mysqli_query($conn, $sql3);
          echo "Product Added";
          header('location: product_list.php');
         }
      }
    }
  }
}
?>


<div class="container">

<?php if(isset($_SESSION['admin_email'])) {  ?>

<form action="" method="POST" class="form-row" enctype="multipart/form-data">
<div class="form-group">
<input type="hidden" name="id" value="<?php echo $id; ?>">
Product Name : <input type="text" name="product" class="form-control" value="<?php echo $product; ?>" required> 
        <span style="color:red"> <?php echo $errproduct ?></span>
SKU: <input type="text" class="form-row" name="sku" value=<?php echo substr(md5($product), 0,10); ?>>
        <span style="color:red"> <?php echo $errsku;?></span>
category :
<?php $categories = mysqli_query($conn, "SELECT * FROM categories"); ?>
<select name="category" class="form-control"  required>
<?php while($rows = mysqli_fetch_assoc($categories)) {?>
  <option value="<?php echo $rows['id']; ?>"><?php echo $rows['category']; ?></option>
  <?php } ?>
</select>
brand :
<?php $brands = mysqli_query($conn, "SELECT * FROM brands"); ?>
<select name="brand" class="form-control" required>
<?php while($row = mysqli_fetch_assoc($brands)) {?>
  <option value="<?php echo $row['id']; ?>"><?php echo $row['brand']; ?></option>
  <?php } ?>
</select>

Image: <input type="file" class="form-control" name="image" required>
Short Description: <textarea name="short_description" rows="2" cols="50" class="form-control" required> </textarea>
Description of Product : <textarea name="description" rows="4" cols="50" class="form-control" required></textarea>
Quantity : <input type="number" name="quantity" class="form-control" required>
Purchase Price : <input type="number" name="purchase_price" class="form-control" required>
MRP : <input type="number" name="mrp" class="form-control" value="<?php echo $mrp; ?>" required>

<button type="submit" name="add" class="btn btn-primary mb-2">
<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 
<span>ADD</button></span>
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