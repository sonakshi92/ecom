<?php
$conn = mysqli_connect('localhost', 'root', '', 'admin');
if(isset($_POST['upload'])) {
    $image = $_FILES['image']['name'];
    $path = 'images/home/'.$image;
    $sql = mysqli_query($conn, "INSERT INTO carousel (image) VALUES ('$path')");
    if($sql){
    move_uploaded_file($_FILES['image']['tmp_name'], $path);
    echo "image uploaded";
    } else {
        echo "image not uploaded";
    }
}

define('title', 'Carousel');
include 'header.php';

?>
<div class="container">

<form action="" method="POST" class="form-row" enctype="multipart/form-data">
Image: <input type="file" class="form-control" name="image" required>
<button type="submit" name="upload" class="btn btn-primary mb-2"> Upload</button>

</form>