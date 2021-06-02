<?php
//echo '<pre>';
//print_r($_GET);
//if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
//$conn = mysqli_connect('localhost', 'root', '', 'admin');
define('title', 'Edit Product');
include 'header.php'; 
$errproduct = '';
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $sql1 = "SELECT * FROM products WHERE id=$id";
    $result = mysqli_query($conn, $sql1);
    if(! empty($result)==1){
        $rows = mysqli_fetch_array($result);
        $product = $rows['product'];
        $category = $rows['category'];
        $brand = $rows['brand'];
        $image = $rows['image'];
        $sku = $rows['sku'];
        $short_description = $rows['short_description'];
        $description = $rows['description'];
        $quantity = $rows['quantity'];
        $purchase_price = $rows['purchase_price'];
        $mrp = $rows['mrp'];
    }
}

if(isset($_POST['update'])){
    $id = get_safe_value($conn, $_POST['id']);
    $product = get_safe_value($conn, $_POST['product']);
    $category = get_safe_value($conn, $_POST['category']);
    $brand = get_safe_value($conn, $_POST['brand']);
    $new_image = get_safe_value($conn, $_FILES['image']);
    $short_description = get_safe_value($conn, $_POST['short_description']);
    $description = get_safe_value($conn, $_POST['description']);
    $quantity = get_safe_value($conn, $_POST['quantity']);
    $purchase_price = get_safe_value($conn, $_POST['purchase_price']);
    $mrp = get_safe_value($conn, $_POST['mrp']);
    $status = get_safe_value($conn, $_POST['status']);
    //print_r($_POST);
    
    if (isset($_FILES['image']['tmp_name']))
    {
        $file = $_FILES['image']['tmp_name'];
        $image  = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $image_name = addslashes($_FILES['image']['name']);
        move_uploaded_file($_FILES["image"]["tmp_name"],"images/shop/" . $_FILES["image"]["name"]);
        $image_save ="images/shop/" . $_FILES["image"]["name"];
    }

    if(empty($product)){
      $errproduct .= "Product cannot be empty";
    } else {
        $sql2 = "UPDATE products SET product='$product', category='$category', brand='$brand', image='$image_save', short_description='$short_description', description='$description', quantity='$quantity', purchase_price='$purchase_price', mrp='$mrp', status='$status' WHERE id=$id";
        $result = mysqli_query($conn, $sql2);
        echo "Record updated successfully";
        header('location: product_list.php');
    }
 } 
?>

<div class="container">

<?php if(isset($_SESSION['admin_email'])) {  ?>
<form action="" method="POST" enctype="multipart/form-data">
<div class="form-group">
<h2>Edit product Details</h2>
 <input type="hidden" name="id" value="<?php echo $rows['id']; ?>">
product Name : <input type="text" class="form-control" name="product" value="<?php echo $rows['product']; ?>" required>
Image: <input type="file" id="imgToUpload" class="form-control" name=image onChange="displayImage(this)" value="<?php echo $rows['image']; ?>" required>
<div class="empty-text">
<img id="image" src=<?php echo $rows['image']; ?> width= "100" alt="previous product image" onClick="triggerClick()" required><br>
</div>
SKU: <input type="text" value=<?php echo $rows['sku']; ?> class="form-control" readonly>
Short Description: <textarea name="short_description" rows="2" cols="50" class="form-control" required> <?php echo $rows['short_description']; ?> </textarea>
Description of Product : <textarea name="description" class="form-control" rows="5" cols="50" required><?php echo $rows['description']; ?></textarea>   
Quantity: <input type="number" class="form-control" name="quantity" value="<?php echo $rows['quantity']; ?>" required> 
Purchase Price: <input type="number" class="form-control" name="purchase_price" value="<?php echo $rows['purchase_price']; ?>" required>
MRP: <input type="number" class="form-control" name="mrp" value="<?php echo $rows['mrp']; ?>" required> 
category :
<?php $categories = mysqli_query($conn, "SELECT * FROM categories"); 
?>
<select name="category" class="form-control" required>
<?php while($rows = mysqli_fetch_assoc($categories)) {
    if($rows['id']==$category){
		echo "<option selected value=".$rows['id'].">".$rows['category']."</option>";
	}else{
  echo "<option value=".$rows['id'].">".$rows['category']."</option>";
 }} ?>
 </select>

brand :
<?php $brands = mysqli_query($conn, "SELECT * FROM brands"); 
?>
<select name="brand" class="form-control" required>
<?php while($row = mysqli_fetch_assoc($brands)) {
    if($row['id']==$brand){
		echo "<option selected value=".$row['id'].">".$row['brand']."</option>";
	}else{
  echo "<option value=".$row['id'].">".$row['brand']."</option>";
 }} ?>
</select>

<button type="submit" name="update" class="btn btn-primary" >Update</button>

</form>
<?php 
} else {
    echo "<script>alert('User Doesnot exist');</script>";
    echo "Invalid Session, try <a href=login.php> logging in</a> here "; 
} 
?>
</div></div>
<script>
    $('#imgToUpload').on('change', function() {

var file = this.files[0];
var imagefile = file.type;
var imageTypes = ["image/jpeg", "image/png", "image/jpg", "image/gif"];
if (imageTypes.indexOf(imagefile) == -1) {
    //display error
    return false;
    $(this).empty();
}
else {
    var reader = new FileReader();
    reader.onload = function(e) {
        $(".empty-text").html('<img src="' + e.target.result + '"  />');
    };
    reader.readAsDataURL(this.files[0]);
}

});
</script>
</body>
</html>