<?php
$conn = mysqli_connect('localhost', 'root', '', 'admin');
if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM brands WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    echo "Record deleted";
}

define('title', 'List all Brands');
include 'header.php';
?>

<div class="container">

    <table class="table table-hover table-striped" id="list">
        <thead class="table-dark">
            <tr>
                <th scope="col"> Brands </th>
                <th scope="col"> Description </th>
                <th scope="col"> Action </th>

            </tr>
        </thead>
        <?php
            $query = mysqli_query($conn, "SELECT * FROM brands");

            while($rows = mysqli_fetch_array($query)){
        ?>
            <tr>
                <td><b><?php echo $rows['brand']; ?></b></td>
                <td><i><?php echo $rows['description']; ?></i></td>
                <td>
                    <a href="brand_add.php?edit=<?php echo $rows['id']; ?>" class="btn btn-primary btn-sm a-btn-slide-text">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>        


                    <a href="brand_list.php?delete=<?php echo $rows['id']; ?>"class="btn btn-danger btn-sm a-btn-slide-text">
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