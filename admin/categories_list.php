<?php
session_start();
$adminSession = $_SESSION['admin_email'];
$conn = mysqli_connect('localhost', 'root', '', 'admin');

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $sql = "DELETE FROM categories WHERE id=$id";
    $del = mysqli_query($conn, $sql);
    echo "Record Deleted";
}

define('title', 'View Categories');
include 'header.php'; ?>


<div class="container">

    <table class="table table-hover table-striped" id="list">
        <thead class="table-dark">
            <tr>
                <th scope="col"> Category </th>
                <th scope="col"> Image </th>
                <th scope="col"> Description </th>
                <th scope="col"> Action </th>

            </tr>
        </thead>
        <?php
            $query = mysqli_query($conn, "SELECT * FROM categories");

            while($rows = mysqli_fetch_array($query)){
        ?>
            <tr>
                <td><b><?php echo $rows['category']; ?></b></td>
                <td><img src="<?php echo $rows['image']; ?>" width=100></td>

                <td><i><?php echo $rows['description']; ?></i></td>
                <td>
                    <a href="category_add.php?edit=<?php echo $rows['id']; ?>" class="btn btn-primary btn-sm a-btn-slide-text">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>        

                    <a href="categories_list.php?delete=<?php echo $rows['id']; ?>"class="btn btn-danger btn-sm a-btn-slide-text">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</a>
        </td>
            </tr>
        <?php } ?>
    </table>
<script>
$(document).ready( function(){
    $('#list').DataTable();
});
</script>
</body>
</html>