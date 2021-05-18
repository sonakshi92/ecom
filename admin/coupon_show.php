<?php
if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
$conn = mysqli_connect('localhost', 'root', '', 'admin');


if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $sql = "DELETE FROM coupon WHERE id=$id";
    $del = mysqli_query($conn, $sql);
    echo "Record Deleted";
}

define('title', 'Display Coupons');
include 'header.php'; 
?>

<div class="container">

<table width=80% class="table table-bordred table-striped" id="list">
    <thead>
        <tr>
            <th> <h2> Coupons </h2></th>
            <th> <h2> Action </h2></th>

        </tr>
    </thead>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'admin');
$query = mysqli_query($conn, "SELECT * FROM coupon");
while($rows = mysqli_fetch_array($query)){
?>
    <tbody>
        <tr>
            <td style="background-image:url('image/discount.jpg')" ><br><h2> &nbsp &nbsp <?php echo $rows['code']; ?> </h2><br>
             <p> &nbsp &nbsp &nbsp Valid till: <?php echo $rows['validity']; ?> </p> <br><br>
            </td>
            <td>
                <a href="coupon_create.php?edit=<?php echo $rows['id']; ?>" class="btn btn-primary btn-sm a-btn-slide-text">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> &nbsp Edit</a>
        
                <a href="coupon_show.php?delete=<?php echo $rows['id']; ?>"class="btn btn-danger btn-sm a-btn-slide-text">
                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> &nbsp Delete</a>
            </td>
        </tr>
    </tbody>
<?php } ?>
</table>
<script>
    $(document).ready(function(){
        $('#list').DataTable();
    });
</script>

</body>
</html>
