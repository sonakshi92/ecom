<?php
//if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
//$conn = mysqli_connect('localhost', 'root', '', 'admin');
define('title', 'Add New Category');
include ('header.php'); 
$errcategory = $category = $description = " ";
$update = false;
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $sql1 = "SELECT * FROM categories WHERE id=$id";
    $result = mysqli_query($conn, $sql1);
    if(! empty($result)==1){
        $rows = mysqli_fetch_array($result);
        $category = $rows['category'];
        $description = $rows['description'];
    }
}

if(isset($_POST['update'])){
    $id = get_safe_value($conn, $_POST['id']);
    $category = get_safe_value($conn, $_POST['category']);
    $image = $_FILES['image']['name'];
    $path = 'images/categories/'.$image;
    move_uploaded_file($_FILES['image']['tmp_name'], $path);
    $description = get_safe_value($conn, $_POST['description']);
    $res = mysqli_query($conn, "SELECT * FROM categories where category='$category'");
      if(empty($category)){
        $errcategory .= "Category cannot be empty";
        if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			    if($id==$getData['id']){
		    	}else{
				$errcategory .= "Categories already exist";
	        	}
    	    }  
    } else {
          $sql2 = "UPDATE categories SET category='$category', image='$path', description='$description' WHERE id=$id";
          $result = mysqli_query($conn, $sql2);
          echo "Record updated successfully";
        }
        header('location: categories_list.php');     
}


if(isset($_POST['add'])){
    $category = get_safe_value($conn, $_POST['category']);
    $description = get_safe_value($conn, $_POST['description']);
    $image = $_FILES['image']['name'];
    $path = 'images/categories/'.$image;
    move_uploaded_file($_FILES['image']['tmp_name'], $path);
    if($category != ''){
        $sql = "SELECT * FROM categories where category='$category'";
        $search = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($search);
        if($rows > 0) {
            $errcategory .= "Category Already Exists";
            }
        } else{
            $sql3 = "INSERT INTO categories (category, image, description, status) VALUES('$category', '$path', '$description', '1')";
            $add = mysqli_query($conn, $sql3);
            echo "Category Added";
       //   header('location: categories_list.php');
        
        }
    }  


?>

<div class="container">
<?php if(isset($_SESSION['admin_email'])) {  ?>

<form action="" method="POST" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo $id; ?>" readonly>
<b>Category Name : </b><input type="text" name="category" value="<?php echo $category; ?>"><span style="color:red"><?php echo $errcategory; ?></span><br><br>
Image: <input type="file" class="form-control" name="image" required>
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